<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailToBuHa extends Mailable
{
    use Queueable, SerializesModels;

    public $asset;
    public $oldCompany;
    public $newCompany;
    public $target;
    public $checkOutNote;

    public function __construct($asset, $oldCompany, $newCompany, $target, $checkOutNote)
    {
        $this->asset = $asset;
        $this->oldCompany = $oldCompany;
        $this->newCompany = $newCompany;
        $this->target = $target;
        $this->checkOutNote = $checkOutNote;
    }

    public function build()
    {
        return $this->subject('Umbuchung eines Assets') // Betreff hier anpassen
        ->view('vendor.mail.html.MailToBuHa')
        ->with([
            'assetTag' => $this->asset->asset_tag,
            'assetId' => $this->asset->id,
            'assetModel' => $this->asset->model->name,
            'assetSerial' => $this->asset->serial,
            'assetPrice' => $this->asset->purchase_cost,
            'oldCompany' => $this->oldCompany,
            'newCompany' => $this->newCompany,
            'target' => $this->target,
            'checkOutNote' => $this->checkOutNote,
        ]);
    }
}