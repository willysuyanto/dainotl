<x-guest-layout>
     <!-- Session Status -->
     <x-auth-session-status class="mb-4" :status="session('status')" />


    <!-- Validation Errors -->
    <x-auth-validation-errors class="alert alert-danger" :errors="$errors" />

     <form method="POST" action="{{ route('login') }}">
         @csrf

         <div class="container container-login container-transparent animated fadeIn">
            <div class="text-center mb-2">
                <img src="{{asset('assets/img/Pertamina.png')}}" height="75px" alt="">
            </div>
             <h3 class="text-center">Masuk ke Sistem</h3>
             <div class="login-form">
                 <div class="form-group">
                     <label for="login" class="placeholder"><b>Username atau Email</b></label>
                     <input id="login" name="login" value="{{old('login')}}" required autofocus type="text" class="form-control">
                 </div>
                 <div class="form-group">
                     <label for="password" class="placeholder"><b>Password</b></label>
                     <a href="#" class="link float-right">Lupa Password ?</a>
                     <div class="position-relative">
                         <input id="password"
                         type="password"
                         name="password"
                         required autocomplete="current-password" class="form-control">
                         <div class="show-password">
                             <i class="icon-eye"></i>
                         </div>
                     </div>
                 </div>
                 <div class="form-group form-action-d-flex mb-3">
                     <div class="custom-control custom-checkbox">
                         <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
                         <label class="custom-control-label m-0" for="remember_me">Ingat Saya</label>
                     </div>
                     <x-button class="btn btn-secondary col-md-5 float-right mt-3 mt-sm-0 fw-bold">
                         Masuk
                     </x-button>
                 </div>
             </div>
         </div>
     </form>
</x-guest-layout>
