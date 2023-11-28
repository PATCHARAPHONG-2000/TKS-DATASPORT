$(function () {
    $("#formRegister").submit(function (e) {
        e.preventDefault();
        let timerInterval
        Swal.fire({
            title: 'Auto close alert!',
            html: 'I will close in <b></b> milliseconds.',
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
            }
        })
        $.ajax({
            type: "POST",
            url: "service/auth/register.php",
            data: $(this).serialize(),
            dataType: 'json'
        }).done(function (resp) {
            console.log(resp);
            if (resp.error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: resp.error,
                })
            } else {
                console.log(resp);
                Swal.fire({
                    title: 'Enter OTP',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off',
                        maxlength: 6
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Verify',
                    showLoaderOnConfirm: true,
                    preConfirm: (otp) => {
                        return new Promise((resolve, reject) => {
                            $.ajax({
                                url: 'service/auth/check_otp.php',
                                type: 'POST',
                                data: {
                                    otp: otp
                                },
                                dataType: 'json',
                                success: function (response) {
                                    if (response.status) {
                                        resolve(response);
                                    } else {
                                        reject(response.message);
                                    }
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                    reject(thrownError);
                                }
                            });
                        }).catch(error => {
                            Swal.showValidationMessage(error)
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    console.log(resp);
                    if (result.isConfirmed) {
                        if (result.value.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'OTP Verified!'
                            }).then(() => {

                                window.location.href = 'login';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid OTP!',
                                text: result.value.message
                            });
                        }
                    }
                })

            }
        });
    });
});


