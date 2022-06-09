<!-- This page is for all users -->


<!-- if the logged in user in owner -->
@role('owner')
    @include('admin.dashboard')
<!-- user "X" section -->
@elserole('user')

@endrole