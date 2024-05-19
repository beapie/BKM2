<?php

namespace Modules\AppointmentReview\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateLang;


class EmailTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $emailTemplate = [
            'Appointment Review',
        ];

        $defaultTemplate = [
            'Appointment Review' => [
                'subject' => 'Appointment Review',
                'variables' => '{
                "Review Subject": "review_subject",
                "App Url": "app_url",
                "App Name": "app_name",
                "Company Name ":"company_name",
                "Business Name": "business_name",
                "Staff Name": "staff_name",
                "Review Url": "review_url"
            }',
                'lang' => [
                    'ar' => '<p>عزيزي {app_name}،<br />
                    شكرًا لك على اختيار {company_name}. نأمل أن تكون راضيًا عن {staff_name}.</p>
                    <p><strong>يُرجى ترك تعليقاتك هنا</strong>: {review_url}</p>
                    <p>شكرًا لك، ونتطلع إلى رؤيتك مرة أخرى في <br />{app_name}.</p>',
                    'da' =>  '<p>Kære {app_name},<br />
                    Tak, fordi du valgte {company_name}. Vi håber, du var tilfreds med din {staff_name}.</p>
                    <p><strong>Send venligst din feedback her</strong>: {review_url}</p>
                    <p>Tak, og vi ser frem til at se dig igen på <br />{app_name}.</p>',
                    'de' => '<p>Lieber {app_name},<br />
                    Vielen Dank, dass Sie sich für {company_name} entschieden haben. Wir hoffen, dass Sie mit Ihrem {staff_name} zufrieden waren.</p>
                    <p><strong>Bitte hinterlassen Sie Ihr Feedback hier</strong>: {review_url}</p>
                    <p>Vielen Dank und wir freuen uns darauf, Sie bei <br />{app_name} wiederzusehen.</p>',
                    'en' =>  '<p>Dear {app_name},<br />
                    Thank you for choosing {company_name}. We hope you were satisfied with your {staff_name}.</p>
                    <p><strong>Please leave your feedback here</strong>: {review_url}</p>
                    <p>Thank you, and we look forward to seeing you again at <br />{app_name}.</p>',
                    'es' => '<p>Estimado {app_name},<br />
                    Gracias por elegir {company_name}. Esperamos que haya quedado satisfecho con su {staff_name}.</p>
                    <p><strong>Deje sus comentarios aquí</strong>: {review_url}</p>
                    <p>Gracias y esperamos verle nuevamente en <br />{app_name}.</p>',
                    'fr' => "<p>Cher {app_name},<br />
                    Merci d'avoir choisi {company_name}. Nous espérons que vous êtes satisfait de votre {staff_name}.</p>
                    <p><strong>Veuillez laisser vos commentaires ici</strong> : {review_url}</p>
                    <p>Merci et nous avons hâte de vous revoir chez <br />{app_name}.</p>",
                    'it' => "<p>Caro {app_name},<br />
                    Grazie per aver scelto {company_name}. Ci auguriamo che tu sia soddisfatto del tuo {staff_name}.</p>
                    <p><strong>Lascia il tuo feedback qui</strong>: {review_url}</p>
                    <p>Grazie e non vediamo l'ora di rivederti presso <br />{app_name}.</p>",
                    'ja' => '<p>{app_name} 様<br />
                    {company_name} をお選びいただきありがとうございます。 {staff_name} にご満足いただければ幸いです。</p>
                    <p><strong>ここにフィードバックを残してください</strong>: {review_url}</p>
                    <p>ありがとうございます。また <br />{app_name} でお会いできるのを楽しみにしています。</p>',
                    'nl' => '<p>Beste {app_name},<br />
                    Bedankt dat u voor {company_name} heeft gekozen. We hopen dat u tevreden bent met uw {staff_name}.</p>
                    <p><strong>Laat hier uw feedback achter</strong>: {review_url}</p>
                    <p>Bedankt, en we kijken ernaar uit je weer te zien bij <br />{app_name}.</p>',
                    'pl' => "<p>Szanowna {app_name},<br />
                    Dziękujemy za wybranie firmy {company_name}. Mamy nadzieję, że jesteś zadowolony ze swojej usługi {staff_name}.</p>
                    <p><strong>Proszę zostaw swoją opinię tutaj</strong>: {review_url</p>
                    <p>Dziękujemy i nie możemy się doczekać ponownego spotkania w firmie <br />{app_name}.</p>",
                    'ru' => '<p>Дорогой {app_name},<br />
                    Благодарим вас за выбор {company_name}. Мы надеемся, что вы остались довольны своим {staff_name}.</p>
                    <p><strong>Оставьте свой отзыв здесь</strong>: {review_url</p>
                    <p>Спасибо и с нетерпением ждем встречи с вами снова в <br />{app_name}.</p>',
                    'pt' => '<p>Caro {app_name},<br />
                    Obrigado por escolher a {company_name}. Esperamos que você esteja satisfeito com seu {staff_name}.</p>
                    <p><strong>Deixe seu feedback aqui</strong>: {review_url}</p>
                    <p>Obrigado e esperamos vê-lo novamente na <br />{app_name}.</p>',
                    'tr' => "<p>Sayın {app_name},<br />
                {company_name}'i seçtiğiniz için teşekkür ederiz. {staff_name} hizmetinizden memnun kaldığınızı umuyoruz.</p>
                <p><strong>Lütfen geri bildiriminizi buraya bırakın</strong>: {review_url</p>
                <p>Teşekkür ederiz ve sizi <br />{app_name} şirketinde tekrar görmeyi sabırsızlıkla bekliyoruz.</p>",
                ],
            ],
        ];

        foreach ($emailTemplate as $eTemp) {
            $table = EmailTemplate::where('name', $eTemp)->where('module_name', 'AppointmentReview')->exists();
            if (!$table) {
                $emailtemplate =  EmailTemplate::create(
                    [
                        'name' => $eTemp,
                        'from' => 'AppointmentReview',
                        'module_name' => 'AppointmentReview',
                        'created_by' => 1,
                        'business_id' => 0
                    ]
                );
                foreach ($defaultTemplate[$eTemp]['lang'] as $lang => $content) {
                    EmailTemplateLang::create(
                        [
                            'parent_id' => $emailtemplate->id,
                            'lang' => $lang,
                            'subject' => $defaultTemplate[$eTemp]['subject'],
                            'variables' => $defaultTemplate[$eTemp]['variables'],
                            'content' => $content,
                            'module_name' => 'AppointmentReview',
                        ]
                    );
                }
            }
        }
    }
}
