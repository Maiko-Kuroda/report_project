$(function () {
    $('.follow-btn').on('click', function () {
        let $this = $(this);
        let $tgUserId = $this.children('.userId').attr('data-userId');
        let $isFollowTmp = '#follow' + $tgUserId;
        let $isFollow = $($isFollowTmp).attr('data-isFollow');
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $isFollow == 1 ? '/user/unfollow' : '/user/follow',
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
                $($isFollowTmp).attr('data-isFollow', data['isFollow']);
                $($isFollowTmp).text(data['isFollow'] == true ? 'フォロー中' : 'フォロー');
            })
            // リクエスト失敗時の処理
            .fail(function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown.message);
            });
    });
});
//コントローラーに情報を渡して、コントローラーからモデルに書き換えて、ビューではif文でフォロー中か否か
