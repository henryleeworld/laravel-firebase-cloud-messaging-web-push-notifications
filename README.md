# Laravel 10 Firebase 雲訊息網絡應用推送通知

引入 code-lts 的 laravel-fcm 套件來擴增 Firebase 雲訊息網絡應用推送通知，推送消息提供了重新吸引用戶的簡單有效方式。

## 使用方式
- 把整個專案複製一份到你的電腦裡，這裡指的「內容」不是只有檔案，而是指所有整個專案的歷史紀錄、分支、標籤等內容都會複製一份下來。
```sh
$ git clone
```
- 將 __.env.example__ 檔案重新命名成 __.env__，如果應用程式金鑰沒有被設定的話，你的使用者 sessions 和其他加密的資料都是不安全的！
- 當你的專案中已經有 composer.lock，可以直接執行指令以讓 Composer 安裝 composer.lock 中指定的套件及版本。
```sh
$ composer install
```
- 產生 Laravel 要使用的一組 32 字元長度的隨機字串 APP_KEY 並存在 .env 內。
```sh
$ php artisan key:generate
```
- 在瀏覽器中輸入已定義的路由 URL 來訪問，例如：http://127.0.0.1:8000。
- 應用程式傳送通知時提示您詢問是否可以要求傳送通知給你，請點選「允許」。
- 你可以經由 `/send/message` 來進行推送通知。

## 畫面截圖
![](https://i.imgur.com/bjuZWux.gif)
> 網絡應用推送通知是個選擇性功能，讓網站即使在未載入時也能傳送訊息給您。網站能使用這個功能提供您推送通知或在背景更新資料