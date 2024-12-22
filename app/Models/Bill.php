<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use chillerlan\QRCode\{QRCode, QROptions};

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_from',
        'advocate',
        'custom_advocate',
        'custom_address',
        'title',
        'bill_number',
        'due_date',
        'items',
        'subtotal',
        'total_tax',
        'total_amount',
        'description',
        'created_by',
        'bill_to',
        'custom_email',

    ];

    public function get_products(){
        return $this->hasOne('App\Models\InvoiceProduct', 'invoice_id', 'id');

    }


    public function get_qrcode($bill){
        $qrcode = new QRCode();
        $invoice_total_amount = round($bill->total_amount, 2);
        //$invoice_date = \Carbon::parse($invoice_date)->toIso8601ZuluString();
        $invoice_date = Carbon::parse($bill->reciept_date)->toIso8601String();
        $company_name = Utility::getValByName('company_name');
        $company_vat = Utility::getValByName('company_vat');
        
        $result = chr(1) . chr( strlen($company_name)) .$company_name;
        $result.= chr(2) . chr( strlen($company_vat)) .$company_vat;
        $result.= chr(3) . chr( strlen($invoice_date )) .$invoice_date;
        $result.= chr(4) . chr( strlen($invoice_total_amount) ) . $invoice_total_amount;
        $result.= chr(5) . chr( strlen($bill->total_tax) ) . $bill->total_tax;
        $qrcodebcd= base64_encode($result);
        
        return $qrcode->render($qrcodebcd);
      
    }

    protected function toHex($value)
    {
        return pack('H*', sprintf('%02X', $value));
    }
}

