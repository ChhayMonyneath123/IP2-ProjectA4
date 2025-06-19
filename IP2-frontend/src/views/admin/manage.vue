<template>
    <div class="container">

        <aside class="sidebar">
            <h2>La Libre</h2>
            <ul>
                <li>Dashboard</li>
                <li>Orders</li>
                <li>Stocks</li>
                <li>Delivery</li>
                <li>Users</li>
                <li>Reviews</li>
                <li>Chats</li>
                <li class="active">Manage Account</li>
            </ul>
        </aside>

        <div class="manage">
            <header class="topbar">
                <h1>Manage Account</h1>
                <img class="profile-img" src="../../assets/logo/logo.png" alt="Profile" />
            </header>

            <div class="card">

                <div class="profile">
                    <div class="class-image">
                        <img src="../../assets/logo/logo.png" class="avatar" alt="User" />
                    </div>
                    <div class="class-text">
                        <h2>Jonh Smith</h2>
                        <p>Administrator</p>
                        <button>Edit</button>
                    </div>
                </div>

                <div class="info">
                <h3>Personal Information</h3>
                <p>Email: <a href="mailto:jonhSmith123@gmail.com">jonhSmith123@gmail.com</a></p>
                <p>Contact: +855 12 336 992</p>

                <div>
                  <hr class="line"/>
                </div>

                <h3>Account Restriction</h3>

                <div class="toggles">
                    <label>
                        <input type="checkbox" />
                        Allow resetting password
                    </label>
                    <label>
                        <input type="checkbox" />
                        Allow user create new account
                    </label>
                </div>
              </div>
            </div>
            <button class="logout">Log Out</button>
        </div>
    </div>
</template>
  
<script>
  
</script>
  
<style scoped>
  .container {
    display: flex;
    height: 100vh;
    margin: 0;
  }

  .sidebar{
    width: 200px;
    background-color: #F8F7F3;
    padding: 20px;
  }

  .sidebar h2{
    margin-bottom: 20px;
    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
  }

  .sidebar ul{
    list-style: none;
    padding: 0;
  }

  .sidebar li{
    padding: 10px;
    cursor: pointer;
    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
  }

  .sidebar .active {
    background: #eee2bc;
    font-weight: bold;
    border-radius: 15px;
  }

  .manage {
    flex: 1;
    position: relative;
    margin: 0;
    font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}

.topbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #F8F7F3;
  font-size:15px;
}
.topbar .profile-img {
  width: 90px;
  border-radius: 50%;
}
.card {
  background: #fff;
  padding: 20px;
  display: block;
}
.profile {
  display: flex;
  margin: 20px;
  gap:40px;
}
.profile .avatar {
  width: 120px;
  border-radius: 50%;
}
.profile button {
  margin-top: 10px;
  padding: 6px 12px;
  background: #d6c697;
  border-radius: 10px;
  border: none;
  cursor: pointer;
  width: 80px;
  height: 40px;
}
.info {
  flex: 1;
  display: block;
  margin-left: 50px;
  margin-top: 60px;
}
.toggles label {
  display: block;
  margin-top: 30px;
}
.logout {
  position: absolute;
  bottom: 20px;
  right: 20px;
  background: #d20000;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  cursor: pointer;
}
.line{
  border: none;
  height: 1px;
  background-color: black;
  margin: 40px 0;
}
</style>
  