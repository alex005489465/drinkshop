<template>
  <div>
    <header>
      <h1 text-3xl font-bold underline>歡迎來到我的飲料店</h1>
      <nav>
        <ul>
          <li><a href="/">首頁</a></li>
          <li><a href="/menu">菜單</a></li>
          <li><a href="/contact">聯絡我們</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <section>
        <h2>今日推薦</h2>
        <p>來嘗試我們的新鮮水果茶吧！</p>
      </section>
    </main>
  </div>
</template>

<script>
export default {
  name: 'HomePage'
}
</script>

<style scoped>
header {
  background-color: #f8f8f8;
  padding: 10px 0;
}
h1 {
  text-align: center;
}
nav ul {
  display: flex;
  justify-content: center;
  list-style: none;
  padding: 0;
}
nav ul li {
  margin: 0 15px;
}
</style>
