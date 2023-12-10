<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    private array $types = ['C' => 'Cartão', 'B' => 'Boleto', 'P' => 'Pix'];

    public function toArray(Request $request): array
    {
        $paid = $this->paid;

        return [
            'user' => [
                'firstName' => $this->user->firstName,
                'lastName' => $this->user->lastName,
                'fullName' => $this->user->firstName . ' ' . $this->user->lastName,
                'email' => $this->user->email,
            ],
            'type' => $this->types[$this->type],
            'value' => 'R$ ' . number_format($this->value, 2, ',', '00'),
            'paid' => $paid ? 'Pago' : 'Nao Pago',
            'PaymentDate' => $paid ? Carbon::parse($this->payment_date)->format('d/m/y H:i:s') : null,
            'PaymentSince' => $paid ? Carbon::parse($this->payment_date)->diffForHumans() : null,
        ];
    }
}
