<?php

namespace Modules\SMS\Database\Seeders;

use App\Models\Notification;
use App\Models\NotificationTemplateLang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $modules = [
            'general'       => ['Create User', 'Create Appointment', 'Appointment Status Change', 'Appointment Reminder']
        ];

        $defaultTemplate = [
            'Create User' => [
                'variables' => '{"Company Name": "company_name","User Name": "user_name" , "business_name":"business_name"}',
                'lang' => [
                    'ar' => 'مستخدم جديد {user_name} تم تكوينه بواسطة {company_name} في {business_name} مساحة العمل',
                    'da' => 'En ny bruger {user_name} er oprettet af {company_name} kl {business_name} arbejdsområde',
                    'de' => 'Ein neuer Benutzer {user_name} wurde erstellt von {company_name} unter {business_name} Arbeitsbereich',
                    'en' => 'A New User {user_name} has been created by {company_name} at {business_name} business',
                    'es' => 'Un nuevo usuario {user_name} ha sido creado por {company_name} en el espacio de trabajo {business_name}',
                    'fr' => 'Un nouvel utilisateur { user_name } a été créé par { company_name } dans espace de travail { business_name }',
                    'it' => 'Un Nuovo utente {user_name} è stato creato da {company_name} a {business_name} spazio di lavoro',
                    'ja' => '新規ユーザー {user_name} が {business_name} ワークスペースで {company_name} によって作成されました。',
                    'nl' => 'Een nieuwe gebruiker {user_name} is gemaakt door {company_name} op {business_name} werkgebied',
                    'pl' => 'Nowy użytkownikc {user_name} został utworzony przez {company_name} o {business_name} obszar roboczy',
                    'ru' => 'Новый пользователь {user_name} создано в {company_name} в {business_name} рабочая область',
                    'pt' => 'Um Novo Usuário {user_name} foi criado por {company_name} em {business_name} espaço de trabalho',
                ],
            ],
            'Create Appointment' => [
                'variables' => '{"Business Name": "business_name" , "Appointment Name" : "appointment_name" , "Date": "date" , "Time" : "time"}',
                'lang' => [
                    'ar' => '{appointment_name} حجز تعيين في {date} في {time} بالنسبة الى {business_name} الأعمال التجارية',
                    'da' => '{appointment_name} booker en aftale om {date} kl {time} for {business_name} forretning',
                    'de' => '{Ernennungsname} hat einen Termin am {date} um {time} für das Geschäft {business_name}',
                    'en' => '{appointment_name} is booking an appointment on {date} at {time} for {business_name} business',
                    'es' => '{appointment_name} está reservando una cita en {date} a las {time} para la empresa {business_name}',
                    'fr' => '{appointment_name} Réservation un rendez-vous le {date} à {time} pour lentreprise {business_name}',
                    'it' => '{appointment_name} sta prenotando un appuntamento su {date} al {time} per {business_name} Attività commerciale',
                    'ja' => '{appointment_name} 予約を予約している {date} で {time} 対象 {business_name} 業務',
                    'nl' => '{appointment_name} is het boeken van een afspraak op {date} op {time} voor {business_name} Zakelijk',
                    'pl' => '{appointment_name} rezerwacji jest umówionym na {date} o {time} dla {business_name} biznesowe',
                    'ru' => '{appointment_name} -это отрезка заднего отверстия {date} в {time} для {business_name} бизнес-бизнес',
                    'pt' => '{appointment_name} está agendando uma consulta em {date} em {time} para {business_name} negócios',
                ],
            ],
            'Appointment Status Change' => [
                'variables' => '{"Status": "status" , "Appointment Name" : "appointment_name"}',
                'lang' => [
                    'ar' => 'الخاص بك {appointment_name} تم طلب التعيين {status}',
                    'da' => 'Din {appointment_name} aftaleanmodning har været {status}',
                    'de' => 'Die Terminanforderung {name_der_bestellung} wurde {status}',
                    'en' => 'Your {appointment_name} appointment request has been {status}',
                    'es' => 'La solicitud de cita de {appointment_name} ha sido {status}',
                    'fr' => 'Votre demande de nomination {appointment_name} a été {status}',
                    'it' => 'La tua richiesta di nomina {appointment_name} è stata {status}',
                    'ja' => 'ユア {appointment_name} 予約要求が行われました {status}',
                    'nl' => 'Uw {appointment_name} aanstellingsopdracht is uitgevoerd {status}',
                    'pl' => 'Twój {appointment_name} żądanie wyznaczenia zostało {status}',
                    'ru' => 'Ваш {appointment_name} заявка на назначение была {status}',
                    'pt' => 'negócios {appointment_name} pedido de nomeação foi {status}',
                ],
            ],
            'Appointment Reminder' => [
                'variables' => '{"Status": "status" , "Appointment Name" : "appointment_name"}',
                'lang' => [
                    'ar' => 'الخاص بك {appointment_name} تم طلب التعيين {status}',
                    'da' => 'Din {appointment_name} aftaleanmodning har været {status}',
                    'de' => 'Die Terminanforderung {name_der_bestellung} wurde {status}',
                    'en' => 'Your {appointment_name} appointment request has been {status}',
                    'es' => 'La solicitud de cita de {appointment_name} ha sido {status}',
                    'fr' => 'Votre demande de nomination {appointment_name} a été {status}',
                    'it' => 'La tua richiesta di nomina {appointment_name} è stata {status}',
                    'ja' => 'ユア {appointment_name} 予約要求が行われました {status}',
                    'nl' => 'Uw {appointment_name} aanstellingsopdracht is uitgevoerd {status}',
                    'pl' => 'Twój {appointment_name} żądanie wyznaczenia zostało {status}',
                    'ru' => 'Ваш {appointment_name} заявка на назначение была {status}',
                    'pt' => 'negócios {appointment_name} pedido de nomeação foi {status}',
                ],
            ],
        ];

        foreach ($modules as $module_name => $actions) {
            foreach ($actions as $action) {
                $ntfy = Notification::where('action', $action)->where('type', 'SMS')->where('module', $module_name)->count();
                if ($ntfy == 0) {
                    $new            = new Notification();
                    $new->action    = $action;
                    $new->status    = 'on';
                    $new->module    = $module_name;
                    $new->type      = 'SMS';
                    $new->save();
                    foreach ($defaultTemplate[$action]['lang'] as $lang => $content) {
                        NotificationTemplateLang::create(
                            [
                                'parent_id' => $new->id,
                                'lang' => $lang,
                                'module' => $new->module,
                                'variables' => $defaultTemplate[$action]['variables'],
                                'content' => $content,
                            ]
                        );
                    }
                }
            }
        }
    }
}
