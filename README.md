# attendance

・概要説明
簡易的な勤怠管理アプリを作成しました。
名前、メールアドレス、パスワードを入力し、
会員登録後に打刻ページにて出勤操作が可能です。

・作成目的
初級模擬案件を通じてクライアントからの要望

・アプリケーションURL
https://github.com/bastille8/attendance.git

・機能一覧

「laravelの認証機能を利用」
会員登録
ログイン
ログアウト

「日を跨いだ（24時を超えた）時点で翌日の出勤操作に切り替え」
勤務開始
勤務終了

「何度でも休憩が可能」
休憩開始
休憩終了

「5件ずつ取得」
日付別勤怠情報取得
ページネーション

・テーブル作成
「ユーザーテーブル」
id	bigint_unsigned　PRIMARY KEY　NOT NULL
name	varchar(191)　NOT NULL
e-mail	varchar(191)　UNIQUE KEY　NOT NULL
password	varchar(191)　NOT NULL
created_at	timestamp
updated_at	timestamp

「スタンプテーブル」
id	bigint_unsigned　PRIMARY KEY　NOT NULL
stamps_id	bigint_unsigned　FOREIGN KEY(users(id)) NOT NULL
stamp_day	date NOT NULL
work_in	time NOT NULL
work_out	time
rest_time	time
created_at	timestamp
updated_at	timestamp

「レストテーブル」
id	bigint_unsigned　PRIMARY KEY　NOT NULL
rests_id	bigint_unsigned　FOREIGN KEY(stamps(id)) NOT NULL
rest_in	time
rest_out	time
created_at	timestamp
updated_at	timestamp

# e-mail2
