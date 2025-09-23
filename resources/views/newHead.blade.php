//
// <!DOCTYPE html>
//     <html lang="en">
//
//     <head>
//         <meta charset="UTF-8">
//         <meta name="viewport" content="width=device-width, initial-scale=1.0">
//         <title>User Dashboard - Family Management System</title>
//         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
//         <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
//     </head>
// <body>
// <div class="container">
//     <div class="row justify-content-center">
//         <div class="col-md-12">
//             <div class="card">
//                 <div class="card-header">{{ __('Add New Head') }}</div>
//                 <div class="card-body">
//                     <form id="headForm" action="{{ route('admin.posthead') }}" method="POST" enctype="multipart/form-data">
//                         @csrf
//
//                         <!-- Head Information -->
//                         <h5>Head Information</h5>
//                         <div class="row">
//                             <div class="col-md-6">
//                                 <div class="form-group">
//                                     <label for="name">Name</label>
//                                     <input type="text" class="form-control" id="name" name="name" required>
//                                 </div>
//                             </div>
//                             <div class="col-md-6">
//                                 <div class="form-group">
//                                     <label for="surname">Surname</label>
//                                     <input type="text" class="form-control" id="surname" name="surname" required>
//                                 </div>
//                             </div>
//                         </div>
//
//                         <div class="row">
//                             <div class="col-md-6">
//                                 <div class="form-group">
//                                     <label for="birthdate">Birth Date</label>
//                                     <input type="date" class="form-control" id="birthdate" name="birthdate" required>
//                                 </div>
//                             </div>
//                             <div class="col-md-6">
//                                 <div class="form-group">
//                                     <label for="mobile">Mobile</label>
//                                     <input type="text" class="form-control" id="mobile" name="mobile" required>
//                                 </div>
//                             </div>
//                         </div>
//
//                         <div class="form-group">
//                             <label for="address">Address</label>
//                             <textarea class="form-control" id="address" name="address" required></textarea>
//                         </div>
//
//                         <div class="row">
//                             <div class="col-md-4">
//                                 <div class="form-group">
//                                     <label for="state">State</label>
//                                     <select class="form-control" id="state" name="state" required>
//                                         <option value="">Select State</option>
//                                         @foreach($states as $state)
//                                             <option value="{{ $state->name }}">{{ $state->name }}</option>
//                                         @endforeach
//                                     </select>
//                                 </div>
//                             </div>
//                             <div class="col-md-4">
//                                 <div class="form-group">
//                                     <label for="city">City</label>
//                                     <select class="form-control" id="city" name="city" required>
//                                         <option value="">Select City</option>
//                                     </select>
//                                 </div>
//                             </div>
//                             <div class="col-md-4">
//                                 <div class="form-group">
//                                     <label for="pincode">Pincode</label>
//                                     <input type="text" class="form-control" id="pincode" name="pincode" required>
//                                 </div>
//                             </div>
//                         </div>
//
//                         <div class="row">
//                             <div class="col-md-6">
//                                 <div class="form-group">
//                                     <label for="marital_status">Marital Status</label>
//                                     <select class="form-control" id="marital_status" name="marital_status" required>
//                                         <option value="">Select Status</option>
//                                         <option value="0">Single</option>
//                                         <option value="1">Married</option>
//                                     </select>
//                                 </div>
//                             </div>
//                             <div class="col-md-6">
//                                 <div class="form-group" id="marriage_date_group" style="display: none;">
//                                     <label for="mariage_date">Marriage Date</label>
//                                     <input type="date" class="form-control" id="mariage_date" name="mariage_date">
//                                 </div>
//                             </div>
//                         </div>
//
//                         <div class="form-group">
//                             <label for="path">Photo</label>
//                             <input type="file" class="form-control" id="path" name="path" accept="image/*" required>
//                         </div>
//
//                         <div class="form-group">
//                             <label>Hobbies</label>
//                             <div id="hobbies-container">
//                                 <div class="hobby-input">
//                                     <input type="text" class="form-control mb-2" name="hobbies[]" placeholder="Enter hobby" required>
//                                 </div>
//                             </div>
//                             <button type="button" class="btn btn-secondary btn-sm" id="add-hobby">Add Hobby</button>
//                         </div>
//
//                         <!-- Members Section -->
//                         <hr>
//                         <h5>Family Members</h5>
//                         <div id="members-container">
//                             <!-- Members will be added here -->
//                         </div>
//                         <button type="button" class="btn btn-secondary" id="add-member">Add Member</button>
//
//                         <hr>
//                         <button type="submit" class="btn btn-primary">Add Head</button>
//                         <a href="{{ route('admin.index') }}" class="btn btn-secondary">Cancel</a>
//                     </form>
//                 </div>
//             </div>
//         </div>
//     </div>
// </div>
// </body>
// <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
// <script>
// $(document).ready(function() {
//     let memberCount = 0;
//
//     // State-City dependency
//     $('#state').change(function() {
//         var state = $(this).val();
//         if (state) {
//             $.get('/get-cities/' + state, function(data) {
//                 $('#city').empty().append('<option value="">Select City</option>');
//                 $.each(data, function(key, city) {
//                     $('#city').append('<option value="' + city.name + '">' + city.name + '</option>');
//                 });
//             });
//         }
//     });
//
//     // Marriage date toggle
//     $('#marital_status').change(function() {
//         if ($(this).val() == '1') {
//             $('#marriage_date_group').show();
//             $('#mariage_date').prop('required', true);
//         } else {
//             $('#marriage_date_group').hide();
//             $('#mariage_date').prop('required', false);
//         }
//     });
//
//     // Add hobby
//     $('#add-hobby').click(function() {
//         $('#hobbies-container').append('<div class="hobby-input"><input type="text" class="form-control mb-2" name="hobbies[]" placeholder="Enter hobby" required><button type="button" class="btn btn-danger btn-sm remove-hobby">Remove</button></div>');
//     });
//
//     $(document).on('click', '.remove-hobby', function() {
//         $(this).parent().remove();
//     });
//
//     // Add member
//     $('#add-member').click(function() {
//         memberCount++;
//         var memberHtml = `
//             <div class="member-section border p-3 mb-3" data-member="${memberCount}">
//                 <h6>Member ${memberCount}</h6>
//                 <div class="row">
//                     <div class="col-md-6">
//                         <div class="form-group">
//                             <label>Name</label>
//                             <input type="text" class="form-control" name="members[${memberCount}][name]" required>
//                         </div>
//                     </div>
//                     <div class="col-md-6">
//                         <div class="form-group">
//                             <label>Surname</label>
//                             <input type="text" class="form-control" name="members[${memberCount}][surname]">
//                         </div>
//                     </div>
//                 </div>
//                 <div class="row">
//                     <div class="col-md-6">
//                         <div class="form-group">
//                             <label>Birth Date</label>
//                             <input type="date" class="form-control" name="members[${memberCount}][birthdate]" required>
//                         </div>
//                     </div>
//                     <div class="col-md-6">
//                         <div class="form-group">
//                             <label>Marital Status</label>
//                             <select class="form-control member-marital-status" name="members[${memberCount}][marital_status]" required>
//                                 <option value="">Select Status</option>
//                                 <option value="0">Single</option>
//                                 <option value="1">Married</option>
//                             </select>
//                         </div>
//                     </div>
//                 </div>
//                 <div class="row">
//                     <div class="col-md-6">
//                         <div class="form-group member-marriage-date" style="display: none;">
//                             <label>Marriage Date</label>
//                             <input type="date" class="form-control" name="members[${memberCount}][mariage_date]">
//                         </div>
//                     </div>
//                     <div class="col-md-6">
//                         <div class="form-group">
//                             <label>Education</label>
//                             <input type="text" class="form-control" name="members[${memberCount}][education]">
//                         </div>
//                     </div>
//                 </div>
//                 <button type="button" class="btn btn-danger btn-sm remove-member">Remove Member</button>
//             </div>
//         `;
//         $('#members-container').append(memberHtml);
//     });
//
//     // Remove member
//     $(document).on('click', '.remove-member', function() {
//         $(this).closest('.member-section').remove();
//     });
//
//     // Member marriage date toggle
//     $(document).on('change', '.member-marital-status', function() {
//         var memberSection = $(this).closest('.member-section');
//         var marriageDateGroup = memberSection.find('.member-marriage-date');
//         var marriageDateInput = marriageDateGroup.find('input');
//
//         if ($(this).val() == '1') {
//             marriageDateGroup.show();
//             marriageDateInput.prop('required', true);
//         } else {
//             marriageDateGroup.hide();
//             marriageDateInput.prop('required', false);
//         }
//     });
//
//     // Form validation
//     $('#headForm').submit(function(e) {
//         var isValid = true;
//         var errorMessage = '';
//
//         // Validate members
//         $('.member-section').each(function() {
//             var memberNum = $(this).data('member');
//             var name = $(this).find('input[name="members[' + memberNum + '][name]"]').val();
//             var birthdate = $(this).find('input[name="members[' + memberNum + '][birthdate]"]').val();
//             var maritalStatus = $(this).find('select[name="members[' + memberNum + '][marital_status]"]').val();
//             var marriageDate = $(this).find('input[name="members[' + memberNum + '][mariage_date]"]').val();
//
//             if (!name || !birthdate || !maritalStatus) {
//                 isValid = false;
//                 errorMessage += 'Please fill all required fields for Member ' + memberNum + '.\n';
//             }
//
//             if (maritalStatus == '1' && !marriageDate) {
//                 isValid = false;
//                 errorMessage += 'Marriage date is required for married Member ' + memberNum + '.\n';
//             }
//         });
//
//         if (!isValid) {
//             e.preventDefault();
//             alert(errorMessage);
//         }
//     });
// });
// </script>
//
