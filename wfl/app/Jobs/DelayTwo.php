<?php

namespace App\Jobs;

use App\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class DelayTwo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->delay(20);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Order $data)
    {
        //
        $status = Appointment::where('status', $data->id)->value('status');
        if($status == '3'){
            Appointment::where('status', $data->id)->update(['status' => '0']);

            Mail::send('emails.borrow',[
                'data' => $data
            ],function($message)use($data){
                $message ->to($data->email)->subject('回复');
            });
            // 发邮件提醒
            Mail::send('emails.borrow', [
                'data' => $data
            ], function ($message) use ($data) {
                $message->to($data->email)->subject('回复');
            });
        }
    }
}
