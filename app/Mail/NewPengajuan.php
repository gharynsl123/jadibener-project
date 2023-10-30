<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPengajuan extends Mailable
{
    use Queueable, SerializesModels;

    public $dataPengajuan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataPengajuan)
    {
        $this->dataPengajuan = $dataPengajuan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.new_pengajuan')
                    ->subject('Pengajuan Baru: ' . $this->dataPengajuan->judul_masalah);
    }
}
