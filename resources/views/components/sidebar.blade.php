<div class="sidebar">

    <div class="logo">
        Jazal Admin
    </div>

    <ul class="menu-list">

        <li>
            <a
                href="/customers"
                class="{{ request()->is('customers') ? 'active-menu' : '' }}"
            >
                Customers
            </a>
        </li>

        <li>
            <a
                href="/services"
                class="{{ request()->is('services') ? 'active-menu' : '' }}"
            >
                Services
            </a>
        </li>

        <li>
            <a
                href="/subscriptions"
                class="{{ request()->is('subscriptions') ? 'active-menu' : '' }}"
            >
                Subscriptions
            </a>
        </li>

    </ul>

</div>