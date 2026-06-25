<?php

namespace App\Enums\Ja;


enum UsState: string
{
    case Alabama       = 'アラバマ州';
    case Alaska        = 'アラスカ州';
    case Arizona       = 'アリゾナ州';
    case Arkansas      = 'アーカンソー州';
    case California    = 'カリフォルニア州';
    case Colorado      = 'コロラド州';
    case Connecticut   = 'コネチカット州';
    case Delaware      = 'デラウェア州';
    case Florida       = 'フロリダ州';
    case Georgia       = 'ジョージア州';
    case Hawaii        = 'ハワイ州';
    case Idaho         = 'アイダホ州';
    case Illinois      = 'イリノイ州';
    case Indiana       = 'インディアナ州';
    case Iowa          = 'アイオワ州';
    case Kansas        = 'カンザス州';
    case Kentucky      = 'ケンタッキー州';
    case Louisiana     = 'ルイジアナ州';
    case Maine         = 'メイン州';
    case Maryland      = 'メリーランド州';
    case Massachusetts = 'マサチューセッツ州';
    case Michigan      = 'ミシガン州';
    case Minnesota     = 'ミネソタ州';
    case Mississippi   = 'ミシシッピ州';
    case Missouri      = 'ミズーリ州';
    case Montana       = 'モンタナ州';
    case Nebraska      = 'ネブラスカ州';
    case Nevada        = 'ネバダ州';
    case NewHampshire  = 'ニューハンプシャー州';
    case NewJersey     = 'ニュージャージー州';
    case NewMexico     = 'ニューメキシコ州';
    case NewYork       = 'ニューヨーク州';
    case NorthCarolina = 'ノースカロライナ州';
    case NorthDakota   = 'ノースダコタ州';
    case Ohio          = 'オハイオ州';
    case Oklahoma      = 'オクラホマ州';
    case Oregon        = 'オレゴン州';
    case Pennsylvania  = 'ペンシルベニア州';
    case RhodeIsland   = 'ロードアイランド州';
    case SouthCarolina = 'サウスカロライナ州';
    case SouthDakota   = 'サウスダコタ州';
    case Tennessee     = 'テネシー州';
    case Texas         = 'テキサス州';
    case Utah          = 'ユタ州';
    case Vermont       = 'バーモント州';
    case Virginia      = 'バージニア州';
    case Washington    = 'ワシントン州';
    case WestVirginia  = 'ウェストバージニア州';
    case Wisconsin     = 'ウィスコンシン州';
    case Wyoming       = 'ワイオミング州';

    public function label(): string
    {
        return $this->value;
    }
}
