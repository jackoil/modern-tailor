<?php

namespace App\Channels;

use DateTimeImmutable;
use Ghasedak\DataTransferObjects\Request\InputDTO;
use Ghasedak\DataTransferObjects\Request\OtpMessageDTO;
use Ghasedak\DataTransferObjects\Request\ReceptorDTO;
use Ghasedak\DataTransferObjects\Request\SingleMessageDTO;
use Ghasedak\Exceptions\GhasedakSMSException;
use Ghasedak\GhasedakApi;
use Ghasedak\GhasedaksmsApi;
use Ipe\Sdk\Facades\SmsIr;
use Illuminate\Notifications\Notification;
use Ghasedak\Laravel\GhasedakFacade;
use Infobip\Resources\WhatsApp\Models\TemplateName;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {

        //dd($notifiable, $notification->code);
         $receptor = $notifiable->cellphone ?? "" ;
        $type = 1;
        $template = "Test";
        $param1 = $notification->code;

        $api = new GhasedaksmsApi(env('GHASEDAK_API_KEY'));

        //$api->verify($receptor, $type, $template, $param1);

        $sendDate = new DateTimeImmutable('now');

        // $response = $api->sendOtp(new OtpMessageDTO($sendDate,
        //       [
        //         new ReceptorDTO(
        //              '09*********',
        //              '1'
        //         )
        //      ],
        //     templateName:  'Ghasedak',
        //     inputs: [
        //         new InputDTO(
        //             param: 'Code',
        //             value: 'value'
        //         ),
        //         new InputDTO(
        //             param: 'Name',
        //             value: 'value'
        //         )
        //     ]
        // ));


        $ghasedaksms = new GhasedaksmsApi(env('GHASEDAK_API_KEY'));
          $sendDate = new DateTimeImmutable('now');
          $lineNumber = '30005088';

          $message =  "code =  " .$param1;

          try {

            $lineNumber = "30007487132347"; // شماره خط فرستنده
            $mobiles = [  ]; // لیست شماره‌های گیرنده
            $mobiles[0] = (string)  $receptor ;
            $sendDateTime = null;   // برای ارسال آنی، مقدار را نال قرار دهید
            $response = SmsIr::bulkSend($lineNumber, $message, $mobiles, $sendDateTime);

            //dd($response, $message);
              $response = $ghasedaksms->sendSingle(new SingleMessageDTO(
                    $sendDate,
                    $lineNumber,
                    $receptor,
                    $message
              ));


          } catch ( GhasedakSMSException  $e) {
               dd('error: '  . $e->getMessage());
          }
    }
}
