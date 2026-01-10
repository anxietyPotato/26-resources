<?php

namespace App\Livewire;

use Livewire\Component;

class ShipmentsAssignedList extends Component
{

    public int $count = 0;
    public int $amount = 1;
    public string $errorMessage = '';
    public function render()
    {
        return view('livewire.shipments-assigned-list');
    }

    public function increment()
    {
            $this->count += $this->amount ;
    }

    public function decrement(){

        $result = $this->count - $this->amount;

       if(  $result >= 0) {
           $this->count -= $this->amount;}

       else {
           $this->errorMessage = 'invalid operation,cant go into negative amount';
       }


    }

    public function validateAmount()
    {
        if ($this->amount < 1) {
            $this->errorMessage = 'invalid operation, amount cant be less than 1';
        } else {
            $this->errorMessage = '';
        }
    }

}
