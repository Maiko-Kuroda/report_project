$(function () {
    $('.like-btn').on('click', function () {
        let $this = $(this);
        let $tgReportId = $this.children('.reportId').attr('data-reportId');
        let $isLikeTmp = '#like' + $tgReportId; //イイねされているかどうかの判断
        let $isLike = $($isLikeTmp).attr('data-isLike');
        // console.log($tgReportId);
        $.ajax({
                headers: { //HTTPヘッダ情報をヘッダ名と値のマップで記述
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, //↑name属性がcsrf-tokenのmetaタグのcontent属性の値を取得
                // url: $isLike == 1 ? '/like' : '/unlike', //通信先アドレスで、このURLをあとでルートで設定します
                url: '/like', //LikeControllerと紐付け（web.phpにて指定したアドレス）
                type: 'POST', //HTTPメソッドの種別を指定します。1.9.0以前の場合はtype:を使用。
                data: { //サーバーに送信するデータ
                    'report_id': $tgReportId //いいねされた投稿のidを送る
                },
            })

            // リクエスト成功時の処理
            .done(function (data) {
                // Laravel内で処理された結果がdataに入って返ってくる
                console.log(data);
                // ステータス更新
                $($isLikeTmp).attr('data-isLike', data['isLike']);
                $($isLikeTmp).text(data['isLike'] == true ? 'イイね中' : 'イイね');
                $("#like_count").text(data['review_likes_count']);
            })

            // リクエスト失敗時の処理
            .fail(function () {
                console.log('fail');
            });
    })
});
