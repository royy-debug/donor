<footer class="bg-red-600 text-white pt-16 pb-6">
    <div class="container mx-auto">
      <div class="flex flex-wrap justify-between mb-8">
        <div class="w-full md:w-1/3 mb-6">
          <img src="{{ asset('images/bottom.svg') }}" alt="Logo" class="mb-4" />
          <p class="text-sm">An application that makes it easy for you to donate blood and help others.</p>
        </div>
        <div class="w-full md:w-1/3 mb-6">
          <h4 class="font-semibold mb-2">Quick Links</h4>
          <ul class="space-y-1 text-sm">
            <li><a href="#home_page">Homepage</a></li>
            <li><a href="#about_us">About Us</a></li>
            <li><a href="#blood_stock">Bloodstock</a></li>
            <li><a href="{{ route('contact') }}">Contact Us</a></li>
          </ul>
        </div>
        <div class="w-full md:w-1/3 mb-6">
          <h4 class="font-semibold mb-2">Contact Us</h4>
          <p class="text-sm">Email: info@blooddonor.com</p>
          <p class="text-sm">Phone: +62 812 3456 7890</p>
        </div>
      </div>
      <div class="text-center text-xs text-gray-200">
        &copy; {{ date('Y') }} Blood Donor. All rights reserved.
      </div>
    </div>
  </footer>
  