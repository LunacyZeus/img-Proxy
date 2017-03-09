# img-Proxy
PHP写的一个图片反代,对开了防盗链图片的网站使用,你懂得.
使用方法:上传到服务器上  然后index.php/?cache=请求的图片地址  如果带了referer参数就可以带referer去请求,没带的话则是获取URL的HOST.
