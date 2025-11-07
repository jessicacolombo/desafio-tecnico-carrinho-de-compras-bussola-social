<?php

namespace App\Enums;

enum PaymentMethods:string
{
    case CREDIT_CARD = 'credit_card';
    case PIX = 'pix';
}