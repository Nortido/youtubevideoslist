<div>
    Total videos: {!! $data->pageInfo->totalResults !!}
</div>
@if (!empty($data->prevPageToken))
    <a href="#" class="js-paginationBtn" data-token="{!! $data->prevPageToken !!}"><< prev</a>
@endif
@if (!empty($data->nextPageToken))
    <a href="#" class="js-paginationBtn" data-token="{!! $data->nextPageToken !!}">next >></a>
@endif