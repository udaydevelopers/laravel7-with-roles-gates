<nav id="sidebar">
        <div class="sidebar-header">
            <h3>Admin Menu</h3>
        </div>
 <ul class="list-group">
  @can('manage-users')
  <li class="list-group-item"><a href="{{ route('admin.users.index') }}">User Management</a></li>
  @endcan
  
  <li class="list-group-item">Create Page</li>
  <li class="list-group-item">Settings</li>
  @can('manage-contacts')
  <li class="list-group-item"><a href="{{ route('admin.contacts.index') }}">Contact Queries</a></li>
  @endcan
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