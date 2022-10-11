<style>
    #main{
        background-color: #0d6efd;
        padding: 10px 15px;
    }
</style>
<section id="main">

    <table>
    <tr>
        <th>Name</th>
        <th>Image</th>
    </tr>
    <tr style="display: flex; flex-direction: column;">
        @foreach ($products as $item)
        <td>{{$item->name}}</td>
        <td><img src="{{asset('uploads/product/'.$item->image)}}" width="70" height="70" alt=""></td>
        @endforeach

    </tr>
    </table>

</section>
