# Laravel Lesson レビュー①

## Todo一覧機能

### Todoモデルのallメソッドで実行しているSQLは何か
SELECT * FROM todos;
→ todosテーブルの全レコードを取得するSQL文

### Todoモデルのallメソッドの返り値は何か
Illuminate\Database\Eloquent\Collection
→ Todoモデルのインスタンスの**コレクション（配列に似たオブジェクト）**が返る。

### 配列の代わりにCollectionクラスを使用するメリットは
メソッドチェーンが使える（コードの可読性と保守性を向上させる）

### view関数の第1・第2引数の指定と何をしているか
return view('todo.index', ['todos' => $todos]);

第1引数：表示するBladeテンプレート名
第2引数：テンプレートに渡す変数（連想配列）

### index.blade.phpの$todos・$todoに代入されているものは何か
$todos：Todo::all() の返り値、つまりTodoモデルの全レコード
$todo：foreachの中で1件ずつ取り出した1つのTodoインスタンス

## Todo作成機能

### Requestクラスのallメソッドは何をしているか
フォームなどで送信されたリクエストの入力値を取得する。

### fillメソッドは何をしているか
渡された連想配列を元に、モデルのプロパティに一括代入。

### $fillableは何のために設定しているか
fill()での一括代入時に、代入を許可する属性を限定するためのホワイトリスト。
セキュリティ対策（Mass Assignment 脆弱性の防止）

### saveメソッドで実行しているSQLは何か
新規作成時なら
INSERT INTO todos (...) VALUES (...);

更新時なら
UPDATE todos SET ... WHERE id = ?;

### redirect()->route()は何をしているか
指定した名前付きルートへリダイレクトする
画面遷移や処理の完了後の遷移先として使う

## その他

### テーブル構成をマイグレーションファイルで管理するメリット
バージョン管理できる
チーム開発でもDB構造が共有できる
デプロイ時にも自動で構築できる
ローカルで簡単にリセットや再構築ができる

### マイグレーションファイルのup()、down()は何のコマンドを実行した時に呼び出されるのか
up()：php artisan migrate
down()：php artisan migrate:rollback や reset

### Seederクラスの役割は何か
データベースに初期データ（ダミーやテスト用）を投入するクラス。
php artisan db:seed で実行

### route関数の引数・返り値・使用するメリット
引数：ルート名
返り値：そのルートに対応するURL文字列
メリット：URLが変わってもルート名で管理できるため、保守性が高い

### @extends・@section・@yieldの関係性とbladeを分割するメリット
@extends：レイアウトテンプレートを指定（共通部分）
@section：各ページで埋め込むコンテンツを定義
@yield：親テンプレート側で@sectionの内容を挿入する位置

### @csrfは何のための記述か
CSRF（クロスサイトリクエストフォージェリ）攻撃を防ぐためのトークンをフォームに埋め込む。
LaravelはこのトークンがないとPOSTリクエストを拒否する仕組みになっている。

### {{ }}とは何の省略系か
PHPの <?php echo ... ?> のBladeテンプレート構文。
HTMLエスケープありで出力する安全な書き方。