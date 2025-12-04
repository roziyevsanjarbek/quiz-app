<style>
    /* Topbar */
    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 20px;
        background: #ffffff;
        border-bottom: 1px solid #e5e5e5;
    }

    /* User profile (dropdown trigger) */
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
    }

    /* Dropdown menu */
    .dropdown-menu {
        position: absolute;
        top: 70px;
        right: 20px;
        width: 160px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        padding: 8px 0;
        z-index: 999;
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

    .hidden {
        display: none;
    }

</style>
<nav class="topbar">
    <div class="topbar-left">
        <h2>Welcome Back, User!</h2>
    </div>

    <div class="topbar-right">
        <div class="user-profile" id="profileBtn">
            <img src="/placeholder.svg?height=40&width=40" alt="Profile" class="profile-avatar">
            <span class="profile-name">John Doe</span>
        </div>

        <!-- Dropdown -->
        <div class="dropdown-menu hidden" id="dropdownMenu">
            <a href="#" class="dropdown-item">👤 Profile</a>
            <a href="#" class="dropdown-item logout">🔚 Logout</a>
        </div>
    </div>
</nav>
<script>
    const profileBtn = document.getElementById('profileBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');

    // Toggle
    profileBtn.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
    });

    // Tashqariga bosilganda yopiladi
    document.addEventListener('click', (e) => {
        if (!profileBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>
