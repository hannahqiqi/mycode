<html>
    <head>
        <title>Lady</title>
        <!-- 新 Bootstrap 核心 CSS 文件 -->
        <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- 可选的Bootstrap主题文件（一般不用引入） -->
        <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

        <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
        <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>

        <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
        <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        
        <script>
            function saveGoods() {
                
                var goodsId = $('#goods-id').val();
                var goodsName = $('#goods-name').val();
                var goodsPrice = $('#goods-price').val();
                
                $.get("storeGoods", {goods_id: goodsId, goods_name: goodsName, goods_price: goodsPrice}, 
                function(){
                    location.reload();
                    
                });
                
            }
            
            function editGoods(goodsId, goodsName, goodsPrice) {
                
                $('#goods-id').val(goodsId);
                $('#goods-name').val(goodsName);
                $('#goods-price').val(goodsPrice);
                
            }
        </script>
    </head>
    <body>
        <div style="width: 500px; margin: 0 auto; margin-top: 50px;">
            <form action="search" method="get" style="display: flex;">
                <input type="search" name="keywords" class="form-control" placeholder="keywords" 
                    value="{{isset($kw) ? $kw : ''}}">
                &nbsp;&nbsp;
                <button type="submit" class="btn btn-primary">Search</button>
                &nbsp;&nbsp;
                <button type="button" class="btn btn-primary" 
                    data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" 
                    onclick="editGoods({{'', '', ''}});">Add</button>
            </form>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Operation</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($goods as $good)
                    <tr>
                        <td>{{$good->id}}</td>
                        <td>{{$good->goods_name}}</td>
                        <td>{{$good->goods_price}}</td>
                        <td>
                            <a href="deleteGoods/{{$good->id}}">Delete</a>
                            &nbsp;&nbsp;
                            <a data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" 
                                onclick="editGoods({{$good->id}}, '{{$good->goods_name}}', 
                                {{$good->goods_price}});">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            @if($pageNum > 1)
                <a href="/lady/public/lady/1">首页</a>
                <a href="/lady/public/lady/{{($pageNum - 1) <= 0 ? 1 : ($pageNum - 1)}}">上一页</a>
            @endif
            
            @if($totalPage > $showPage && $pageNum > $pageOffset + 1)
                ...
            @endif
            @for($i=$start; $i <= $end; $i++)
                 <a href="/lady/public/lady/{{$i}}">{{$i}}</a>
            @endfor
            @if($totalPage > $showPage && $pageNum + $pageOffset < $totalPage)
                ...
            @endif
            
            @if($pageNum < $totalPage)
                <a href="/lady/public/lady/{{$pageNum >= $totalPage ? $totalPage : ($pageNum + 1)}}">下一页</a>
                <a href="/lady/public/lady/{{$totalPage}}">尾页</a>
            @endif
            &nbsp;&nbsp;共{{$totalPage}}页
        </div>
        
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" 
            aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" 
                        aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">New goods</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="goods-id">
                    <div class="form-group">
                        <label for="goods-name" class="control-label">Goods name:</label>
                        <input type="text" class="form-control" id="goods-name">
                    </div>
                    <div class="form-group">
                        <label for="goods-price" class="control-label">Goods price:</label>
                        <input type="number" class="form-control" id="goods-price">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveGoods();">Save goods</button>
                </div>
                </div>
            </div>
        </div>
    </body>
</html>