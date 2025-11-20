@extends('layouts.app')
@section('title', 'Checkout')

@section('content')

@php
    $minAmount = (float) env('MIN_ORDER_AMOUNT_INR', 50);
@endphp

<style>
/* (include your CSS — omitted here for brevity in the reply; keep your original styles) */
.checkout-container { max-width:800px; margin:60px auto; padding:30px; background:#fff; border-radius:12px; box-shadow:0 8px 30px rgba(0,0,0,0.06); }
.checkout-header { text-align:center; margin-bottom:18px; }
.course-list { border-radius:10px; overflow:hidden; border:1px solid #eee; }
.course-list li { padding:12px 16px; display:flex; justify-content:space-between; border-bottom:1px solid #f6f6f6; align-items:center; }
.course-list li:last-child { border-bottom:none; }
.total-line { font-weight:700; color:#16a085; }
.btn-gradient { background:linear-gradient(45deg,#16a085,#27ae60); color:#fff; border:none; padding:12px 18px; border-radius:10px; font-weight:700; }
.btn-disabled { opacity:0.6; pointer-events:none; }
#stripe-modal { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.55); z-index:9999; justify-content:center; align-items:center; transition: opacity 0.3s ease; }
.payment-card { width:420px; max-width:94%; padding:20px; border-radius:12px; background:#fff; box-shadow:0 10px 30px rgba(0,0,0,0.12); }
#submit { width:100%; padding:10px 14px; border-radius:8px; border:none; font-weight:700; }
.spinner { display:inline-block; width:18px; height:18px; border-radius:50%; border:2px solid rgba(255,255,255,0.5); border-top-color:white; animation:spin 1s linear infinite; vertical-align:middle; margin-left:8px; }
@keyframes spin { to { transform:rotate(360deg); } }
.note { font-size:0.9rem; color:#6c757d; margin-top:8px; }
</style>

<div class="checkout-container">
    <div class="checkout-header">
        <h2>Checkout</h2>
        <p class="text-muted">Secure payment powered by Stripe</p>
    </div>

    @if($cartItems->count() > 0)
        <ul class="course-list list-unstyled mb-3">
            @foreach($cartItems as $item)
                <li>
                    <input type="checkbox" class="course-checkbox me-2" data-fee="{{ $item->course->fees }}" value="{{ $item->course->id }}" checked>
                    <span>{{ $item->course->title }}</span>
                    <span>₹{{ number_format($item->course->fees, 2) }}</span>
                </li>
            @endforeach
            <li class="total-line d-flex justify-content-between">
                <span>Total</span>
                <span id="total-amount">₹{{ number_format($total, 2) }}</span>
            </li>
        </ul>

        <div class="alert alert-warning d-none" id="min-amount-alert">
            Minimum order amount is <strong>₹{{ number_format($minAmount, 2) }}</strong>. Add more courses to continue.
        </div>

        <div class="text-center">
            <button id="buy-now" class="btn-gradient">Proceed to Payment</button>
            <div class="note">You will be charged securely via Stripe. Minimum order ₹{{ number_format($minAmount, 2) }}.</div>
        </div>

        <!-- Stripe Modal -->
        <div id="stripe-modal" aria-hidden="true">
            <div class="payment-card">
                <h4 style="margin-bottom:12px;">Enter Payment Details</h4>
                <form id="payment-form">
                    @csrf
                    <div id="card-element" class="my-3 p-3 border rounded"></div>
                    <div id="card-errors" class="text-danger mb-3" role="alert"></div>
                    <button id="submit" class="btn btn-primary" type="submit">Pay ₹{{ number_format($total, 2) }}</button>
                </form>
            </div>
        </div>

        {{-- Hidden flags --}}
        @if($singlePurchase ?? false)
            <input type="hidden" id="singlePurchase" value="true">
            <input type="hidden" id="courseId" value="{{ $cartItems->first()?->course->id }}">
        @else
            <input type="hidden" id="singlePurchase" value="false">
        @endif

    @else
        <div class="text-center py-5">
            <h5>Your cart is empty</h5>
            <a href="{{ url('/') }}" class="btn btn-secondary mt-3">Continue shopping</a>
        </div>
    @endif
</div>

<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if($singlePurchase ?? false)
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.course-checkbox').forEach(cb => cb.style.display = 'none');
});
</script>
@endif

<script>
document.addEventListener("DOMContentLoaded", function() {
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.headers.common['Accept'] = 'application/json';
    axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}';

    const stripe = Stripe("{{ env('STRIPE_KEY') }}");
    const elements = stripe.elements();
    const cardElement = elements.create('card', { hidePostalCode: true });
    let isCardMounted = false;

    const buyNowBtn = document.getElementById('buy-now');
    const stripeModal = document.getElementById('stripe-modal');
    const paymentForm = document.getElementById('payment-form');
    const cardErrors = document.getElementById('card-errors');
    const submitBtn = document.getElementById('submit');
    const totalAmountEl = document.getElementById('total-amount');
    const minAmountAlert = document.getElementById('min-amount-alert');
    const checkboxes = document.querySelectorAll('.course-checkbox');

    const singlePurchase = document.getElementById('singlePurchase')?.value === 'true';
    const singleCourseId = document.getElementById('courseId')?.value || null;

    function updateTotal() {
        let total = 0;
        let selected = [];

        checkboxes.forEach(cb => {
            if(cb.checked) {
                total += parseFloat(cb.dataset.fee);
                selected.push(cb.value);
            }
        });

        if (singlePurchase) {
            // single checkout — ensure we use the single course fee (checkbox might be hidden)
            const firstCb = document.querySelector('.course-checkbox');
            if (firstCb) total = parseFloat(firstCb.dataset.fee || 0);
            selected = [singleCourseId];
        }

        totalAmountEl.textContent = '₹' + total.toFixed(2);

        if(total < {{ $minAmount }}) {
            buyNowBtn.classList.add('btn-disabled');
            buyNowBtn.disabled = true;
            minAmountAlert.classList.remove('d-none');
        } else {
            buyNowBtn.classList.remove('btn-disabled');
            buyNowBtn.disabled = false;
            minAmountAlert.classList.add('d-none');
        }

        return { total, selected };
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));

    function setProcessing(state, amount) {
        if (state) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Processing <span class="spinner"></span>';
        } else {
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Pay ₹' + amount.toFixed(2);
        }
    }

    buyNowBtn.addEventListener('click', () => {
        const { total, selected } = updateTotal();
        if(!singlePurchase && selected.length === 0) {
            Swal.fire({ icon:'warning', title:'No course selected', text:'Please select at least one course to proceed.' });
            return;
        }

        stripeModal.style.display = 'flex';
        if (!isCardMounted) {
            cardElement.mount('#card-element');
            isCardMounted = true;
        }
        submitBtn.innerHTML = 'Pay ₹' + total.toFixed(2);
    });

    paymentForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        cardErrors.textContent = '';
        const { total, selected } = updateTotal();
        setProcessing(true, total);

        try {
            const coursesToSend = singlePurchase ? [singleCourseId] : selected;

            // Create PaymentIntent on server
            const createResp = await axios.post('{{ route('checkout.createPaymentIntent') }}', {
                _token: '{{ csrf_token() }}',
                courses: coursesToSend,
                singlePurchase: singlePurchase
            });

            if (createResp.data.error) throw new Error(createResp.data.error);

            const clientSecret = createResp.data.clientSecret;
            const orderId = createResp.data.order_id;

            // Confirm card payment
            const result = await stripe.confirmCardPayment(clientSecret, {
                payment_method: { card: cardElement }
            });

            if (result.error) throw new Error(result.error.message);

            // Call complete endpoint to finalize order, enroll and clear cart if needed
            const completeResp = await axios.post('{{ route('checkout.complete') }}', {
                _token: '{{ csrf_token() }}',
                order_id: orderId,
                payment_id: result.paymentIntent.id,
                courses: coursesToSend,
                singlePurchase: singlePurchase,
                course_id: singleCourseId
            });

            if (completeResp.data.error) throw new Error(completeResp.data.error);

            stripeModal.style.display = 'none';

            Swal.fire({
                icon: 'success',
                title: 'Payment Successful 🎉',
                text: 'Thank you! Your payment has been processed successfully.',
                showConfirmButton: false,
                timer: 2500
            }).then(() => {
                window.location.href = '{{ url('/orders') }}/' + orderId;
            });
        } catch (err) {
            console.error('Checkout error', err);
            let message = 'Something went wrong. Please try again.';
            if (err.response?.data?.error) message = err.response.data.error;
            else if (err.message) message = err.message;
            cardErrors.textContent = message;
            Swal.fire({ icon: 'error', title: 'Payment failed', text: message });
        } finally {
            setProcessing(false, total);
        }
    });

    // initial
    updateTotal();
});
</script>

@endsection
