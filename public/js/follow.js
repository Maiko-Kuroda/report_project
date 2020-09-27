$(function () {
    $('.follow-btn').on('click', function () {
        $this = $(this);
        $tgUserId = $this.children('.userId').attr("data-userId");
        $isFollow = $this.children('.isFollow').attr("data-isFollow");
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $isFollow == 'true' ? '/user/unfollow' : '/user/follow',
                type: 'POST', //リクエストタイプ
                data: {
                    'user_id': $tgUserId
                }, // リクエストデータ
            })
            // リクエスト成功時の処理
            .done(function (data) {
                // Laravel内で処理された結果がdataに入って返ってくる
                console.log(data['isFollow']);
                // ステータス更新
                $this.children('.isFollow').attr("data-isFollow", data['isFollow']);
                $this.children('.isFollow').text(data['isFollow'] == true ? 'フォロー中' : 'フォローする');
            })
            // リクエスト失敗時の処理
            .fail(function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown.message);
            });
    });
});

//コントローラーに情報を渡して、コントローラーからモデルに書き換えて、ビューではif文でフォロー中か否か
