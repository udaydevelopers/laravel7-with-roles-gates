<nav id="sidebar">
        <div class="sidebar-header">
            <h3>Admin Menu</h3>
        </div>
 <ul class="list-group">
  <li class="list-group-item"><a href="{{ route('admin.users.index') }}">User Management</a></li>
  <li class="list-group-item">Create Page</li>
  <li class="list-group-item">Settings</li>
  <li class="list-group-item">Contact Queries</li>
  <li class="list-group-item"><a  href="{{ route('logout') }}"
        onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
            </a></li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</ul>
    </nav>