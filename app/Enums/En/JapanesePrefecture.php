<?php

namespace App\Enums\En;

enum JapanesePrefecture: string
{
    case Hokkaido  = 'Hokkaido';
    case Aomori    = 'Aomori';
    case Iwate     = 'Iwate';
    case Miyagi    = 'Miyagi';
    case Akita     = 'Akita';
    case Yamagata  = 'Yamagata';
    case Fukushima = 'Fukushima';
    case Ibaraki   = 'Ibaraki';
    case Tochigi   = 'Tochigi';
    case Gunma     = 'Gunma';
    case Saitama   = 'Saitama';
    case Chiba     = 'Chiba';
    case Tokyo     = 'Tokyo';
    case Kanagawa  = 'Kanagawa';
    case Niigata   = 'Niigata';
    case Toyama    = 'Toyama';
    case Ishikawa  = 'Ishikawa';
    case Fukui     = 'Fukui';
    case Yamanashi = 'Yamanashi';
    case Nagano    = 'Nagano';
    case Shizuoka  = 'Shizuoka';
    case Aichi     = 'Aichi';
    case Mie       = 'Mie';
    case Shiga     = 'Shiga';
    case Kyoto     = 'Kyoto';
    case Osaka     = 'Osaka';
    case Hyogo     = 'Hyogo';
    case Nara      = 'Nara';
    case Wakayama  = 'Wakayama';
    case Tottori   = 'Tottori';
    case Shimane   = 'Shimane';
    case Okayama   = 'Okayama';
    case Hiroshima = 'Hiroshima';
    case Yamaguchi = 'Yamaguchi';
    case Tokushima = 'Tokushima';
    case Kagawa    = 'Kagawa';
    case Ehime     = 'Ehime';
    case Kochi     = 'Kochi';
    case Fukuoka   = 'Fukuoka';
    case Saga      = 'Saga';
    case Nagasaki  = 'Nagasaki';
    case Kumamoto  = 'Kumamoto';
    case Oita      = 'Oita';
    case Miyazaki  = 'Miyazaki';
    case Kagoshima = 'Kagoshima';
    case Okinawa   = 'Okinawa';

    public function label(): string
    {
        return $this->value;
    }
}
