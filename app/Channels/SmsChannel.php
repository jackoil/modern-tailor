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
use Illuminate\Notifications\Notification;
use Ghasedak\Laravel\GhasedakFacade;
use Infobip\Resources\WhatsApp\Models\TemplateName;

class SmsChannel
{
    public function send($notifiable, Notification $notification)
    {

        //dd($notifiable, $notification->code);
        $receptor = $notifiable->cellphone ?? "09361722175";
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
          $receptor = '09361722175';
          $message =  "code = 12345";

          try {
              $response = $ghasedaksms->sendSingle(new SingleMessageDTO(
                    $sendDate,
                    $lineNumber,
                    $receptor,
                    $message
              ));
             //dd($response);
          } catch ( GhasedakSMSException  $e) {
               dd($e->getMessage());
          }
    }
}
