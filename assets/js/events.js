// $(document).ready(function () {
//   var table = $("#employeeTable").DataTable({
//     paging: true,
//     ordering: false,
//     searching: false,
//     info: true,
//   });

//   $("#select_all").on("click", function () {
//     $(".checkbox").prop("checked", this.checked);
//   });

//   $(".checkbox").on("click", function () {
//     if ($(".checkbox:checked").length === $(".checkbox").length) {
//       $("#select_all").prop("checked", true);
//     } else {
//       $("#select_all").prop("checked", false);
//     }
//   });

//   $("#add-data").on("click", function () {
//     // รวบรวม ID ของ checkbox ที่ถูกเลือก
//     var selectedIds = $(".checkbox:checked")
//       .map(function () {
//         return $(this).val();
//       })
//       .get();

//     // ตรวจสอบว่ามี checkbox ถูกเลือกหรือไม่
//     if (selectedIds.length > 0) {
//       // ส่งข้อมูลไปยัง PHP script
//       $.ajax({
//         type: "POST",
//         url: "../../service/managercard/create-information.php",
//         data: { idc: selectedIds },
//         success: function (resp) {
//           Swal.fire({
//             text: "เพิ่มข้อมูลเรียบร้อย",
//             icon: "success",
//             confirmButtonText: "ตกลง",
//           }).then((result) => {
//             if (result.isConfirmed) {
//               location.assign("./");
//             }
//           });
//         },
//       });
//     } else {
//       // ถ้าไม่มี checkbox ถูกเลือก
//       Swal.fire({
//         text: "กรุณาเลือกอย่างน้อยหนึ่งรายการ",
//         icon: "warning",
//         confirmButtonText: "ตกลง",
//       });
//     }
//   });

//   // ตรวจสอบการเลือก checkbox เพื่ออัปเดตสถานะของ select_all
//   table.on("draw", function () {
//     if ($(".checkbox:checked").length === $(".checkbox").length) {
//       $("#select_all").prop("checked", true);
//     } else {
//       $("#select_all").prop("checked", false);
//     }
//   });
// });

// $(function () {
//   $("#add-data").click("submit", function (e) {
//     e.preventDefault();
//     $.ajax({
//       type: "POST",
//       url: "../../service/managercard/create-information.php",
//       data: $("#add-data").serialize(),
//     }).done(function (resp) {
//       Swal.fire({
//         text: "เพิ่มข้อมูลเรียบร้อย",
//         icon: "success",
//         confirmButtonText: "ตกลง",
//         timer: 1000,
//         timerProgressBar: true,
//       }).then((result) => {
//         location.assign("./");
//       });
//     });
//   });
// });

// $(function () {
//   $.ajax({
//     type: "GET",
//     url: "../../service/managercard/index",
//   })
//     .done(function (data) {
//       let $data = [];
//       let tableData = [];
//       data.response.forEach(function (item, index) {
//         // ตรวจสอบว่า IsActive เป็น 1 หรือไม่
//         if (
//           item.IsActive == 1 &&
//           item.firstname !== null &&
//           item.lastname !== null
//         ) {
//           tableData.push([
//             ++index,
//             item.firstname,
//             item.lastname,
//             item.status,
//             item.department,
//             item.province,
//             `<img src="../../service/uploads/${item.image}" alt="Image" name="" style="max-width: 50px;">`,
//             `<span class="badge badge-success" style="width: 70px; height: 20px; display: flex; justify-content: center; align-items: center; font-size: 13px">เรียร้อย</span>`,
//             `<div class="btn-group" role="group">
//                     <button type="button" class="btn btn-danger" id="delete" data-id="${item.id}" data-index="${index}">
//                         <i class="far fa-trash-alt"></i> ลบ
//                     </button>
//                 </div>`,
//           ]);
//         }
//       });
//       initDataTables(tableData);
//     })
//     .fail(function () {
//       Swal.fire({
//         text: "ไม่สามารถเรียกดูข้อมูลได้",
//         icon: "error",
//         confirmButtonText: "ตกลง",
//       }).then(function () {
//         location.assign("../dashboard");
//       });
//     });

//   function initDataTables(tableData) {
//     var table = $("#logs").DataTable({
//       data: tableData,
//       searching: false,
//       ordering: false,
//       columns: [
//         { title: "ลำดับ", className: "align-middle", orderable: false },
//         { title: "ชื่อจริง", className: "align-middle", orderable: false },
//         { title: "นามสกุล", className: "align-middle", orderable: false },
//         { title: "ตำแหน่ง", className: "align-middle", orderable: false },
//         { title: "ฝ่าย", className: "align-middle", orderable: false },
//         { title: "จังหวัด", className: "align-middle", orderable: false },
//         { title: "รูปภาพ", className: "align-middle", orderable: false },
//         { title: "สถานะ", className: "align-middle", orderable: false },
//         { title: "จัดการ", className: "align-middle", orderable: false },
//       ],

//       responsive: {
//         details: {
//           display: $.fn.dataTable.Responsive.display.modal({
//             header: function (row) {
//               var data = row.data();
//               return "ผู้ใช้งาน: " + data[1];
//             },
//           }),
//           renderer: $.fn.dataTable.Responsive.renderer.tableAll({
//             tableClass: "table",
//           }),
//         },
//       },
//       language: {
//         lengthMenu: "แสดงข้อมูล _MENU_ แถว",
//         zeroRecords: "ยังไม่มีรายชื่อ",
//         info: "แสดงหน้า _PAGE_ จาก _PAGES_",
//         infoEmpty: "ยังไม่มีรายชื่อ",
//         infoFiltered: "(filtered from _MAX_ total records)",
//         paginate: {
//           previous: "ก่อนหน้านี้",
//           next: "หน้าต่อไป",
//         },
//       },
//     });

//     $(document).on("click", "#delete", function () {
//       let id = $(this).data("id");
//       let index = $(this).data("index");
//       Swal.fire({
//         text: "คุณแน่ใจหรือไม่...ที่จะลบรายการนี้?",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonText: "ใช่! ลบเลย",
//         cancelButtonText: "ยกเลิก",
//       }).then((result) => {
//         if (result.isConfirmed) {
//           // ทำการ Ajax เรียก PHP script เพื่ออัปเดต IsActive เป็น 1
//           $.ajax({
//             type: "POST",
//             url: "../../service/managercard/update-information.php",
//             data: { id: id },
//           }).done(function (response) {
//             if (response.success) {
//               Swal.fire({
//                 text: response.message,
//                 icon: "success",
//                 confirmButtonText: "ตกลง",
//                 timer: 500,
//                 timerProgressBar: true,
//               }).then((result) => {
//                 location.assign("./");
//               });
//             } else {
//               Swal.fire({
//                 text: response.error,
//                 icon: "error",
//                 confirmButtonText: "ตกลง",
//               });
//             }
//           });
//         }
//       });
//     });
//   }
// });
