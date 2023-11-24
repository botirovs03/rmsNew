<template>
    <div id="screen">
        <header>
          <div id="NavButton">
            <button @click="navbar">
                <fa icon="bars" />
            </button>
            
          </div>
            <div id="logoContainer">Logo</div>

            <nav>
                <div class="links">
                    <Link href="/">
                        <fa icon="users-line" />
                        <span> DASHBOARD </span>
                    </Link>
                </div>
                <div class="links">
                    <Link href="/user">
                        <fa icon="users-line" />
                        <span>User Management</span>
                    </Link>
                </div>
                <div class="links">
                    <Link href="/role">
                        <fa icon="users-line" />
                        <span>Role Management</span>
                    </Link>
                </div>
                <div class="links">
                    <Link href="/table">
                        <fa icon="users-line" />
                        <span>Table Management</span>
                    </Link>
                </div>
                <div class="links">
                    <Link href="/transaction">
                        <fa icon="users-line" />
                        <span>Transactions</span>
                    </Link>
                </div>
                <div class="links">
                    <Link href="/menu">
                        <fa icon="users-line" />
                        <span>Menu</span>
                    </Link>
                </div>
                <div class="links">
                    <Link href="/category">
                        <fa icon="users-line" />
                        <span>Category</span>
                    </Link>
                </div>
                <div class="links">
                    <Link href="/order">
                        <fa icon="users-line" />
                        <span>Orders</span>
                    </Link>
                </div>
            </nav>
        </header>

        <article>
            <slot />
        </article>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        Link,
    },
    data() {
        return {
            navbarState: true,
        };
    },
    methods: {
        navbar() {
            if (this.navbarState) {
                document.querySelector("#screen").style.marginLeft = "7%";
                document.querySelector("#screen").style.width = "93%";
                document.querySelector("header").style.marginLeft = "-18%";
                let spans = document.querySelectorAll("a span");
                spans.forEach((span)=>{
                    span.style.width = "0%";
                })
                this.navbarState = false;
            } else {
                document.querySelector("#screen").style.marginLeft = "25%";
                document.querySelector("#screen").style.width = "75%";
                document.querySelector("header").style.marginLeft = "0%";
                let spans = document.querySelectorAll("a span");
                spans.forEach((span)=>{
                    span.style.width = "100%";
                })
                this.navbarState = true;
            }
        },
    },
};
</script>

<style scoped>
*{
    /* border: 1px solid black; */
}
#screen {
    padding: 90px 40px 0 40px;
    background-color: #fef7e5;
    height: 100vh;
    width: 75%;

    margin-left: 25%;
    transition: all 0.3s;
}
header {
    left: 0;
    top: 0;
    position: absolute;
    height: 100vh;
    width: 25%;
    border-radius: 0px 45px 80px 0px;
    background-color: #f9e4a3;
    margin-left: 0%;
    transition: all 0.3s;
}

#logoContainer {
    padding: 50px;
    font-size: 30px;
    text-align: center;
}

nav {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

#NavButton {
  position: absolute;
  right: 25px;
  top: 25px;
}

#NavButton button {
  background: none;
  border: none;
  width: 30px;
  height: 30px;
  font-size: 24px;
}

#NavButton button:hover {
transform: scale(1.2);  
}

#NavButton button:active {
transform: scale(0.9);  
}



.links {
    margin: 10px;
    user-select: none;
}

.links svg {
    display: block;
    margin: 10px;
    color: black;    
    font-size: 36px;
}

a {
    font-size: 28px;
    height: 30px;
    width: 100%;
    display: flex;
    justify-content: end;
    flex-direction: row;
    align-items: center;
    align-content: center;
    flex-wrap: nowrap;
    text-decoration: none;
    color: #333;
}

a span {
   overflow: hidden;
   width: 100%;
   transition: width 0.3s;
   white-space: nowrap;
}

article {
  padding: 15px;
    height: calc(100%);
    border-radius: 50px;
    border: 1px solid #f9e4a3;
}
</style>
