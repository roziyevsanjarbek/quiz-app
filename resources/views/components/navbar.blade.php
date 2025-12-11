<style>
    .user-profile {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        position: relative;
    }

    .profile-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #4a90e2;
        color: #fff;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        user-select: none;
    }

    /* Dropdown menu */
    .dropdown-menu {
        position: absolute;
        top: 60px;
        right: 0;
        width: 160px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        padding: 8px 0;
        z-index: 999;
        transform: scaleY(0);
        transform-origin: top;
        transition: transform 0.2s ease-in-out;
    }

    .dropdown-menu.show {
        transform: scaleY(1);
    }

    .dropdown-item {
        display: block;
        padding: 10px 15px;
        color: #333;
        text-decoration: none;
        font-weight: 500;
    }

    .dropdown-item:hover {
        background: #f3f3f3;
    }

    .logout {
        color: #d00;
    }
</style>

<nav class="topbar">
    <div class="topbar-left">
        <h2>Welcome Back, <span id="navbarUser">User</span>!</h2>
    </div>

    <div class="topbar-right">
        <div class="user-profile" id="profileBtn">
            <div class="profile-avatar" id="profileAvatar">U</div>
        </div>

        <!-- Dropdown -->
        <div class="dropdown-menu" id="dropdownMenu">
            <a class="dropdown-item {{ request()->is('super/profile*') ? 'active' : '' }}"
               href="{{ route('profile') }}">
                👤 Profile
            </a>
            <a class="dropdown-item {{ request()->is('super/logout*') ? 'active' : '' }}"
               href="{{ route('logout') }}">
                🔚 Chiqish
            </a>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const profileBtn = document.getElementById('profileBtn');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const navbarUser = document.getElementById("navbarUser");
        const profileAvatar = document.getElementById("profileAvatar");

        // Username olish
        const userName = localStorage.getItem("userName") || "User";
        navbarUser.textContent = userName;

        // Avatarga ismning birinchi harfini qo‘yish
        profileAvatar.textContent = userName.charAt(0).toUpperCase();

        // Dropdown toggle
        profileBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });

        // Tashqariga bosilganda yopish
        document.addEventListener('click', () => {
            dropdownMenu.classList.remove('show');
        });
    });
</script>
