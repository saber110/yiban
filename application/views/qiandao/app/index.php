

  <article class="jumbotron">
    <header>
      <h1>中南大学易签到</h1>
      <p>\(“▔3▔)/\(“▔3▔)/\(“▔3▔)/</p>
      <a href="{base_url()}qiandao/create" class="btn btn-success" >创建</a>
    </header>
    {if !empty($events)}
    <section style="margin-top: 20px">
      <table class="table table-bordered">
        <title>历史记录</title>
        <thead>
        <tr>
          <th>id</th>
          <th>名称</th>
          <th>时间</th>
          <th>详情</th>
        </tr>
        </thead>
        {foreach $events as $event}
        <tbody>
        <tr >
          <td>{$event.event_id}</td>
          <td>{$event.event_name}</td>
          <td>{$event.created_date}</td>
          <td><a href="{base_url()}qiandao/detail/{$event.event_id}">详情</a></td>
        </tr>
        </tbody>
        {/foreach}
      </table>
    </section>
    {/if}
  </article>



