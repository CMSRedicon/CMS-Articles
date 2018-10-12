<input type="radio" name="is_public" data-article-id="{{$article_id}}" data-cmsr-trigger="sendArticleVisibility" value="1" @if($checked) checked @endif> Tak<br>
<input type="radio" name="is_public" data-article-id="{{$article_id}}" data-cmsr-trigger="sendArticleVisibility" value="0" @if(!$checked) checked @endif> Nie<br>
//todo komunikat/chmurka że zapisało