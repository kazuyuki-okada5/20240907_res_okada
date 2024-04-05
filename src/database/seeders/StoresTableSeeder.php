<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\Area;
use App\Models\Genre;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 店舗名の配列を定義
        $storeNames =[
            '仙人',
            '牛助',
            '戦慄',
            'ルーク',
            '志摩屋',
            '香',
            'JJ',
            'らーめん極み',
            '鳥雨',
            '築地色合',
            '晴海',
            '三子',
            '八戒',
            '福助',
            'ラー北',
            '翔',
            '経緯',
            '漆',
            'THE TOOL',
            '木船',
        ];
        // 店舗概要の配列を定義
        $storeOverviews = [
            '料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで気軽に使用することができます。',
            '焼肉業界で20年間経験を積み、肉を熟知したマスターによる実力派焼肉店。長年の実績とお付き合いをもとに、なかなか食べられない希少部位も仕入れております。また、ゆったりとくつろげる空間はお仕事終わりの一杯や女子会にぴったりです。',
            '気軽に立ち寄れる昔懐かしの大衆居酒屋です。キンキンに冷えたビールを、なんと199円で。鳥かわ煮込み串は販売総数100000本突破の名物料理です。仕事帰りに是非御来店ください。',
            '都心にひっそりとたたずむ、古民家を改築した落ち着いた空間です。イタリアで修業を重ねたシェフによるモダンなイタリア料理とソムリエセレクトによる厳選ワインとのペアリングが好評です。ゆっくりと上質な時間をお楽しみください。',
            'ラーメン屋とは思えない店内にはカウンター席はもちろん、個室も用意してあります。ラーメンはこってり系・あっさり系ともに揃っています。その他豊富な一品料理やアルコールも用意しており、居酒屋としても利用できます。ぜひご来店をお待ちしております。',
            '大小さまざまなお部屋をご用意してます。デートや接待、記念日や誕生日など特別な日にご利用ください。皆様のご来店をお待ちしております。',
            'イタリア製ピザ窯芳ばしく焼き上げた極薄のミラノピッツァや厳選されたワインをお楽しみいただけます。女子会や男子会、記念日やお誕生日会にもオススメです。',
            '一杯、一杯心を込めて職人が作っております。味付けは少し濃いめです。 食べやすく最後の一滴まで美味しく飲めると好評です。',
            '素材の旨味を存分に引き出す為に、塩焼を中心としたお店です。比内地鶏を中心に、厳選素材を職人が備長炭で豪快に焼き上げます。清潔な内装に包まれた大人の隠れ家で贅沢で優雅な時間をお過ごし下さい。',
            '鮨好きの方の為の鮨屋として、迫力ある大きさの握りを1貫ずつ提供致します。',
            '毎年チャンピオン牛を買い付け、仙台市長から表彰されるほどの上質な仕入れをする精肉店オーナーの本当に美味しい国産牛を食べてもらいたいという思いから誕生したお店です。',
            '最高級の美味しいお肉で日々の疲れを軽減していただければと贅沢にサーロインを盛り込んだ御膳をご用意しております。',
            '当店自慢の鍋や焼き鳥などお好きなだけ堪能できる食べ放題プランをご用意しております。飲み放題は2時間と3時間がございます。',
            'ミシュラン掲載店で磨いた、寿司職人の旨さへのこだわりはもちろん、 食事をゆっくりと楽しんでいただける空間作りも意識し続けております。 接待や大切なお食事にはぜひご利用ください。',
            'お昼にはランチを求められるサラリーマン、夕方から夜にかけては、学生や会社帰りのサラリーマン、小上がり席もありファミリー層にも大人気です。',
            '博多出身の店主自ら厳選した新鮮な旬の素材を使ったコース料理をご提供します。一人一人のお客様に目が届くようにしております。',
            '職人が一つ一つ心を込めて丁寧に仕上げた、江戸前鮨ならではの味をお楽しみ頂けます。鮨に合った希少なお酒も数多くご用意しております。他にはない海鮮太巻き、当店自慢の蒸し鮑、是非ご賞味下さい。',
            '店内に一歩足を踏み入れると、肉の焼ける音と芳香が猛烈に食欲を掻き立ててくる。そんな漆で味わえるのは至極の焼き肉です。',
            '非日常的な空間で日頃の疲れを癒し、ゆったりとした上質な時間を過ごせる大人の為のレストラン&バーです。',
            '毎日店主自ら市場等に出向き、厳選した魚介類が、お鮨をはじめとした繊細な料理に仕立てられます。また、選りすぐりの種類豊富なドリンクもご用意しております。',
        ];
        // 店舗urlの配列
        $imageUrls = [
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/ramen.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/yakiniku.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/italian.jpg',
            'https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/sushi.jpg',

        ];
        // エリアとジャンルの対応付け
        $areaGenreMapping = [
            ['area_id' => 1, 'genre_id' => 1], //エリアIDが1でジャンルIDが1の組み合わせ
            ['area_id' => 2, 'genre_id' => 2],
            ['area_id' => 3, 'genre_id' => 3],
            ['area_id' => 4, 'genre_id' => 4],
            ['area_id' => 5, 'genre_id' => 5],
            ['area_id' => 6, 'genre_id' => 6],
            ['area_id' => 7, 'genre_id' => 7],
            ['area_id' => 8, 'genre_id' => 8],
            ['area_id' => 9, 'genre_id' => 9],
            ['area_id' => 10, 'genre_id' => 10],
            ['area_id' => 11, 'genre_id' => 11],
            ['area_id' => 12, 'genre_id' => 12],
            ['area_id' => 13, 'genre_id' => 13],
            ['area_id' => 14, 'genre_id' => 14],
            ['area_id' => 15, 'genre_id' => 15],
            ['area_id' => 16, 'genre_id' => 16],
            ['area_id' => 17, 'genre_id' => 17],
            ['area_id' => 18, 'genre_id' => 18],
            ['area_id' => 19, 'genre_id' => 19],
            ['area_id' => 20, 'genre_id' => 20],
        ];

        // エリアとジャンルに対応するデータを stores テーブルに作成
        foreach($areaGenreMapping as $index => $mapping){
            // エリアとジャンルのモデルを取得
            $area = Area::find($mapping['area_id']);
            $genre = Genre::find($mapping['genre_id']);

            // エリアとジャンルに関連付けられたストアを作成
            $store = new Store();
            // 店舗名を設定
            $store->name = $storeNames[$index];
            $store->area()->associate($area);
            $store->genre()->associate($genre);
            $store->store_overview = $storeOverviews[$index];
            $store->image_url = $imageUrls[$index];
            $store->save();
        }
    }
}
