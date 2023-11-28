function moveToNext(currentInput, nextInputId) {
  const digit = currentInput.value;
  if (digit.length === 1) {
    document.getElementById(nextInputId).focus();
  }
}

$(function () {
  $("#resetpassword").click(function (e) {
    e.preventDefault();
    Swal.fire({
      title: "กรุณากรอกอีเมลของคุณ",
      input: "email",
      inputAttributes: {
        autocapitalize: "off",
      },
      showCancelButton: true,
      confirmButtonText: "Look up",
      showLoaderOnConfirm: true,
      preConfirm: (email) => {
        window.currentEmail = email;
        return new Promise((resolve, reject) => {
          $.ajax({
            url: "service/auth/reset_pw_email.php",
            type: "POST",
            data: { email: email },
            dataType: "json",
            success: function (response) {
              if (response.status) {
                resolve(response);
              } else {
                reject(response.message);
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              console.log(xhr.responseText);
              reject(thrownError);
            },
          });
        }).catch((error) => {
          Swal.showValidationMessage(error);
        });
      },
      allowOutsideClick: () => !Swal.isLoading(),
    }).then((result) => {
      console.log(result);
      if (result.isConfirmed) {
        Swal.fire({
          title: "Enter OTP",
          input: "text",
          inputAttributes: {
            autocapitalize: "off",
            maxlength: 6,
          },
          showCancelButton: true,
          confirmButtonText: "Verify",
          showLoaderOnConfirm: true,
          preConfirm: (otp) => {
            return new Promise((resolve, reject) => {
              $.ajax({
                url: "service/auth/reset_pw_otp.php",
                type: "POST",
                data: {
                  otp: otp,
                },
                dataType: "json",
                success: function (response) {
                  if (response.status) {
                    resolve(response);
                  } else {
                    reject(response.message);
                  }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                  reject(thrownError);
                },
              });
            }).catch((error) => {
              Swal.showValidationMessage(error);
            });
          },
        }).then((otpResult) => {
          if (otpResult.isConfirmed) {
            Swal.fire({
              title: "Enter your new password",
              html: `<input type="password" id="password" class="swal2-input" placeholder="New Password">
               <input type="password" id="c_password" class="swal2-input" placeholder="Confirm Password">`,
              confirmButtonText: "Change Password",
              focusConfirm: false,
              preConfirm: () => {
                const password =
                  Swal.getPopup().querySelector("#password").value;
                const c_password =
                  Swal.getPopup().querySelector("#c_password").value;
                if (!password || !c_password) {
                  Swal.showValidationMessage(
                    `Please enter both password fields`
                  );
                } else if (password !== c_password) {
                  Swal.showValidationMessage("Passwords do not match");
                }
                return { password: password, c_password: c_password };
              },
            }).then((result) => {
              if (result.value) {
                const { password, c_password } = result.value;

                $.ajax({
                  url: "service/auth/reset_pw_otp.php",
                  type: "POST",
                  data: {
                    new_password: password,
                    confirm_password: c_password,
                    email: window.currentEmail,
                  },
                  dataType: "json",
                  success: function (response) {
                    if (response.status) {
                      Swal.fire({
                        title: "สำเร็จ!",
                        text: "คุณได้เปลี่ยนรหัสผ่านของคุณเรียบร้อยแล้ว",
                        icon: "success",
                      }).then(() => {
                        window.location.href = "index.php"; // แก้ไข URL ให้ถูกต้อง
                      });
                    } else {
                      Swal.fire({
                        title: "ผิดพลาด!",
                        text: response.message,
                        icon: "error",
                      });
                    }
                  },
                  error: function () {
                    Swal.fire({
                      title: "ผิดพลาด!",
                      text: "มีข้อผิดพลาดเกิดขึ้นในการเปลี่ยนรหัสผ่านของคุณ โปรดลองใหม่",
                      icon: "error",
                    });
                  },
                });
              }
            });
          }
        });
      }
    });
  });
});
