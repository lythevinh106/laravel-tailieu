{{-- <div class=" toast my-toast align-items-center position-fixed  text-bg-primary border-0  show fade"
    style="top: 8%;right: 1%;z-index: 88 !important" role="alert" aria-live="assertive" aria-atomic="true"
    data-bs-autohide="true">
    <div class="d-flex bg-white text-black">
        <div
            class="toast-body d-flex align-items-center justify-content-between w-100 
		
		{{ $bg_color }}
		
		text-white">
            <span> {{ $message }} </span> <img class="ms-3" src="public/images/bell.gif" alt="">

            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>


    </div>

</div> --}}



<!-- ////toast -->

<div class="toast my-toast show align-items-center text-bg-primary border-0  z-3 position-fixed "
    style="top: 8%;right: 1%;" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex bg-white text-black">
        <div
            class="toast-body d-flex align-items-center justify-content-between w-100
        
        {{ $bg_color = '#ffffff' }}
        
        ">
            <span> {{ $message }} </span> <img class="ms-3" src="{{ asset('client/public/images/bell.gif') }}"
                alt="">


            <img src="{{ asset('client/public/images/close.gif') }}" class="cursor" data-bs-dismiss="toast"
                aria-label="Close" style=" height: 20px ;
           width: 20px;" alt="">
        </div>




    </div>
</div>
