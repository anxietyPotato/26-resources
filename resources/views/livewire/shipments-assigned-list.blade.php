
<div>
    <p>count of clicks : {{ $count }}</p>

    <button wire:click= "increment" >click</button>
    <button wire:click="decrement">decrement</button>

    <p> {{$errorMessage}}</p>

    <input type="number" min ="1 " wire:model.debounce="amount" />

    <p> amount is {{ $amount }}</p>
</div>
