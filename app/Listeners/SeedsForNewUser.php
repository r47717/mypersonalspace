<?php

namespace App\Listeners;

use App\Models\Quote;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\InteractsWithQueue;

class SeedsForNewUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $quotes = [
            [
                "quote" => "Жизнь - это то, что с тобой происходит, пока ты строишь планы",
                "author" => "Джон Леннон"
            ],
            [
                "quote" => "Через 20 лет вы будете больше разочарованы теми вещами, которые вы не делали, чем теми, которые вы сделали. Так отчальте от тихой пристани. Почувствуйте попутный ветер в вашем парусе. Двигайтесь вперед, действуйте, открывайте!",
                "author" => "Марк Твен"
            ],
            [
                "quote" => "Начинать всегда стоит с того, что сеет сомнения",
                "author" => "Борис Натанович Стругацкий"
            ],
            [
                "quote" => "Вы никогда не пересечете океан, если не наберетесь мужества потерять берег из виду",
                "author" => "Христофор Колумб"
            ],
            [
                "quote" => "Если вы думаете, что на что-то способны, вы правы; если думаете, что у вас ничего не получится - вы тоже правы",
                "author" => "Генри Форд"
            ],
            [
                "quote" => "Лучшая месть – огромный успех",
                "author" => "Фрэнк Синатра"
            ],
            [
                "quote" => "Зачастую говорят, что мотивации хватает ненадолго. Но то же самое происходит и с освежающим душем, поэтому и рекомендуют его принимать ежедневно",
                "author" => "Зиг Зиглар"
            ],
            [
                "quote" => "Некоторые вещи могут завладеть вашим вниманием, но сосредоточьтесь лучше на тех, что завладевают вашим сердцем",
                "author" => "Неизвестный автор"
            ],
            [
                "quote" => "Начните оттуда, где вы сейчас находитесь. Используйте то, что у вас есть и делайте все, что можете",
                "author" => "Артур Эш"
            ],
        ];

        foreach ($quotes as $item) {
            $quote = new Quote;
            $quote->user_id = $event->user->id;
            $quote->quote = $item["quote"];
            $quote->author = $item["author"];
            $quote->save();
        }


    }
}
