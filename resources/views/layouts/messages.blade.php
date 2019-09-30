<script>
 $(document).ready(function(){

   // Mensaje exito
   @if(Session::has('msg-success'))
       toastr.success('{{session('msg-success')}}', '¡Éxito!', {timeOut: 4000});
   @php
     session()->forget('msg-success');
   @endphp
   @endif

   // Mensaje advertencia
   @if(Session::has('msg-warning'))
       toastr.warning('{{session('msg-warning')}}', 'Advertencia!', {timeOut: 4000});
   @php
     session()->forget('msg-warning');
   @endphp
   @endif

   // Mensaje error
   @if(Session::has('msg-error'))
       toastr.error('{{session('msg-error')}}', 'Error!', {timeOut: 4000});
   @php
     session()->forget('msg-error');
   @endphp
   @endif
 });
   
</script>