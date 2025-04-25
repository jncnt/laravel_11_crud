<div>
    <!-- Act only according to that maxim whereby you can, at the same time, will that it should become a universal law. - Immanuel Kant -->
</div>

<form action="{{ route('register') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label >Name</label>
        <input type="text" name="name" required>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Username</label>
        <input type="text" name="text" required>
    </div>
    <div class="mb-4">
        <label >Password</label>
        <input type="password" name="password" required>
    </div>
    <div class="mb-4">
        <label >Confirm Password</label>
        <input type="password" name="password_confirmation"  required>
    </div>
    <button type="submit" >Register</button>
    <div class="text-center mt-4">
        Already have an account?  
        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
    </div>
</form>