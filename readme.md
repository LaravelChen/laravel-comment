# Laravel5.4+Vuejs实现嵌套评论
> 此Demo中的样式或者其他的时间，头像之类的设置，请按照自己的喜好实现，我只实现核心逻辑与功能，你若有更好的实现方法，请分享，谢谢！

### Demo地址
**Github** ~ https://github.com/LaravelChen/laravel-comment

### 利用Vuejs实现此功能的原由
我之前写过一个嵌套评论的Demo，是直接用Laravel5.4实现的，整个实现的过程也非常的清晰明了。项目说明在这里:

**Laravel China**:https://laravel-china.org/articles/5556/implementation-of-nested-comments-in-laravel5#reply22

**个人网站**:https://laravelchen.com/article/36

 在这之后，我的一个同学按照此步骤实现之后，想用 ```Vuejs```实现，让整个评论没有刷新，用户体验更高！那么在实现的过程中，有很多地方使他无法实现这个功能，甚至想用```Vuex```来解决一些问题！so，我打算亲自试试用```Vuejs```来实现这个功能，顺便也为更多的遇到此类问题的朋友提供一个解决办法，Demo中的一些小问题，比如样式或者权限的设置交由你自己实现了，这里就不多阐述了！
接下来，直接开始看项目了!

### 准备工作
准备工作和之前利用```Laravel5.4```实现的嵌套评论基本一致，唯一要变化的是我们在```Comment```表增加一个字段```level```这个字段主要是来表示评论所属的层级数，若不设置这个```level```字段，则嵌套的层级数是无穷的，所以我最大设置为**3**,在下面的动态图中可以看到，当层级数为**3**的时候，则不再缩进显示了，这也是为了整个样式的美观考虑的。此外，为了让大家迅速的在本地实现Demo的效果，我简单的封装了命令，在终端下，执行以下命令:
```
php artisan createData
```
即可创建测试数据,最后放路由试试吧!**祝你好运**~哈哈！

### 实现想法
结合我的同学遇到的问题，我认为整个实现过程的难点在于怎么给创建来的```json```对象赋值，我们都知道，在```vuejs```中，父组件向子组件传值是行得通的，而子组件向父组件传值是不太好实现的，有可能你会想用```vuex```，或者利用```$on```和```$emit```方法实现，但是作为开发者来说，用简单且有效的方法是首选，so，我只直接在子组件里面重新定义一个变量，让 ```props```接受的值直接赋予给新创建的值，这样我将增加数据的操作直接放在新创建的值中，最后递归给下一个循环组件，这样就巧妙的实现了嵌套评论。
在这里还得着重讲一下我们后端整理的数据的结构，我是这样的：
```
public function getComments()
    {
        return $this->comments()->with('owner')->get()->groupBy('parent_id');
    }
```
其中```groupBy```是关键，我直接用```parent_id```作为分组标准，其中没有```parent_id```的直接赋予```root```，来表明是一个没有子评论的评论.
如下面:
```
$collections = $post->getComments();
$collections['root'] = $collections[''];
unset($collections['']);
```
这样一来,打印的数据的结构如下:
```
{
"1": [
	 {
		"id": 2,
		"user_id": 3,
		"post_id": 1,
		"parent_id": 1,
		"body": "哈哈哈哈",
		"created_at": "2017-08-17 11:53:01",
		"updated_at": "2017-08-17 11:53:01",
		"level": 1,
		"owner": {
			"id": 3,
			"name": "Norwood Bogan",
			"email": "orion72@example.org",
			"created_at": "2017-08-17 23:59:41",
			"updated_at": "2017-08-17 23:59:41"
			}
	}
],
"root": [
	{
		"id": 1,
		"user_id": 2,
		"post_id": 1,
		"parent_id": null,
		"body": "这是一条评论\n",
		"created_at": "2017-08-17 10:58:00",
		"updated_at": "2017-08-17 10:58:00",
		"level": 0,
		"owner": {
			"id": 2,
			"name": "LaravelChen",
			"email": "848407695@qq.com",
			"created_at": "2017-08-17 14:48:40",
			"updated_at": "2017-08-17 14:48:40"
		}
	}
]
}
```
这样结构非常的清晰，我们只需要传入 ```root``` 这个数组给父组件即可，然后子组件按照相应的条件进行递归即可完成.那么具体的```vue```组件的代码请自行下载Demo进行查看.

### 效果图
![image](https://github.com/LaravelChen/laravel-comment/raw/master/public/images/laravel-comment.gif)

> 如果对你有帮助可以点个赞哦 ☺!


