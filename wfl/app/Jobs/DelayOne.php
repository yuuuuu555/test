<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Appointment;

class DelayOne implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Data $data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Data $data)
    {
        if($data->status == '2'){
            Appointment::where('id', $data->id)->update(['status' => '7']);
            Mail::send('emails.borrow', [
                'data' => $data
            ], function ($message) use ($data) {
                $message->to($data->email)->subject('回复');
            });
            $next = Appointment::where('BookId', $data->BookId)->where('status', '1')->first();
            // dd($next->id);
            if (empty($next->id)) {
                // 无人排队中
                // 查找书籍的存量
                $save = Books::where('id', $data->BookId)->value('save');
                $saves = $save + 1;
                // dd($saves);
                Books::where('id', $data->BookId)->update([
                    'status' => '10',
                    'save' => $saves,
                ]);
                return redirect('admin/history')->with('success', '还书成功1');
            } else {
                // 有人排队
                $data = Appointment::where('id', $next->id)->update(['status' => '2']);
                // 提醒人来拿书

                Mail::send('emails.borrow', [
                    'data' => $data
                ], function ($message) use ($data) {
                    $message->to($data->email)->subject('回复');
                });
                // 延时任务1
                DelayOne::dispatch($data)->delay(Carbon::now()->addMinutes(2));
                return redirect('admin/history')->with('success', '还书成功2');
            }
        }
    }
}
