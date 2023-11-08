<div>
    <table class="table table-summary">
        <tbody>
            <tr class="summary-subtotal">
                <td>Subtotal:</td>
                <td>${{number_format($total, 2)}}</td>
            </tr><!-- End .summary-subtotal -->
            <tr class="summary-shipping">
                <td>Shipping:</td>
                <td>&nbsp;</td>
            </tr>

            <tr class="summary-shipping-row">
                <td>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="free-shipping" name="shipping" wire:click="finalTotal(0)" @if(session('type_shipping') == 'Free Shipping') checked @endif class="custom-control-input">
                        <label class="custom-control-label" for="free-shipping">Free Shipping</label>
                    </div><!-- End .custom-control -->
                </td>
                <td>$0.00</td>
            </tr>

            <tr class="summary-shipping-row">
                <td>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="standart-shipping" name="shipping" wire:click="finalTotal(10)" @if(session('type_shipping') == 'Standart') checked @endif class="custom-control-input">
                        <label class="custom-control-label" for="standart-shipping">Standart</label>
                    </div><!-- End .custom-control -->
                </td>
                <td>$10.00</td>
            </tr>

            <tr class="summary-shipping-row">
                <td>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="express-shipping" name="shipping" wire:click="finalTotal(20)" @if(session('type_shipping') == 'Express') checked @endif class="custom-control-input">
                        <label class="custom-control-label" for="express-shipping">Express</label>
                    </div><!-- End .custom-control -->
                </td>
                <td>$20.00</td>
            </tr>

            

            <tr class="summary-total">
                <td>Total: </td>
                <td>${{number_format($fnTotal, 2)}}</td>
            </tr><!-- End .summary-total -->
        </tbody>
    </table>
</div>
