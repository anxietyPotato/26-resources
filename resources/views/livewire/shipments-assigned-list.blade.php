
<div>
    <p>count of clicks : <span class ="{{$count >= 5000 ? "red" : ""}}">{{$count}}</span></p>

    <button wire:click= "increment" >click</button>
    <button wire:click="decrement">decrement</button>

    <p> {{$errorMessage}}</p>

    <input type="number"
           min="1"
           wire:model.debounce="amount"
           wire:blur="validateAmount"
    />

    <p> amount is {{ $amount }}</p>


    <style>
        .red { color: red; }
    </style>
</div>
