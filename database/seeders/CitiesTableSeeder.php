<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        $cities = [
            // Andhra Pradesh (state_id = 1)
            ['name'=>'Visakhapatnam', 'state_id'=>1, 'latitude'=>'17.6868', 'longitude'=>'83.2185', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Vijayawada', 'state_id'=>1, 'latitude'=>'16.5062', 'longitude'=>'80.6480', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Guntur', 'state_id'=>1, 'latitude'=>'16.3067', 'longitude'=>'80.4365', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Tirupati', 'state_id'=>1, 'latitude'=>'13.6288', 'longitude'=>'79.4192', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Arunachal Pradesh (state_id = 2)
            ['name'=>'Itanagar', 'state_id'=>2, 'latitude'=>'27.0844', 'longitude'=>'93.6053', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Naharlagun', 'state_id'=>2, 'latitude'=>'27.1050', 'longitude'=>'93.6950', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Assam (state_id = 3)
            ['name'=>'Guwahati', 'state_id'=>3, 'latitude'=>'26.1445', 'longitude'=>'91.7362', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Dibrugarh', 'state_id'=>3, 'latitude'=>'27.4728', 'longitude'=>'94.9120', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Silchar', 'state_id'=>3, 'latitude'=>'24.8333', 'longitude'=>'92.7789', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Bihar (state_id = 4)
            ['name'=>'Patna', 'state_id'=>4, 'latitude'=>'25.5941', 'longitude'=>'85.1376', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Gaya', 'state_id'=>4, 'latitude'=>'24.7914', 'longitude'=>'85.0002', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Muzaffarpur', 'state_id'=>4, 'latitude'=>'26.1209', 'longitude'=>'85.3647', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bhagalpur', 'state_id'=>4, 'latitude'=>'25.2425', 'longitude'=>'86.9842', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Chhattisgarh (state_id = 5)
            ['name'=>'Raipur', 'state_id'=>5, 'latitude'=>'21.2514', 'longitude'=>'81.6296', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bhilai', 'state_id'=>5, 'latitude'=>'21.1938', 'longitude'=>'81.3509', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bilaspur', 'state_id'=>5, 'latitude'=>'22.0797', 'longitude'=>'82.1409', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Goa (state_id = 6)
            ['name'=>'Panaji', 'state_id'=>6, 'latitude'=>'15.4909', 'longitude'=>'73.8278', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Margao', 'state_id'=>6, 'latitude'=>'15.2993', 'longitude'=>'74.1240', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Vasco da Gama', 'state_id'=>6, 'latitude'=>'15.3955', 'longitude'=>'73.8313', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Gujarat (state_id = 7)
            ['name'=>'Ahmedabad', 'state_id'=>7, 'latitude'=>'23.0225', 'longitude'=>'72.5714', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Surat', 'state_id'=>7, 'latitude'=>'21.1702', 'longitude'=>'72.8311', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Vadodara', 'state_id'=>7, 'latitude'=>'22.3072', 'longitude'=>'73.1812', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Rajkot', 'state_id'=>7, 'latitude'=>'22.3039', 'longitude'=>'70.8022', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Gandhinagar', 'state_id'=>7, 'latitude'=>'23.2156', 'longitude'=>'72.6369', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Haryana (state_id = 8)
            ['name'=>'Chandigarh', 'state_id'=>8, 'latitude'=>'30.7333', 'longitude'=>'76.7794', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Faridabad', 'state_id'=>8, 'latitude'=>'28.4089', 'longitude'=>'77.3178', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Gurgaon', 'state_id'=>8, 'latitude'=>'28.4595', 'longitude'=>'77.0266', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Panipat', 'state_id'=>8, 'latitude'=>'29.3909', 'longitude'=>'76.9635', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Himachal Pradesh (state_id = 9)
            ['name'=>'Shimla', 'state_id'=>9, 'latitude'=>'31.1048', 'longitude'=>'77.1734', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Dharamshala', 'state_id'=>9, 'latitude'=>'32.2190', 'longitude'=>'76.3234', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Manali', 'state_id'=>9, 'latitude'=>'32.2396', 'longitude'=>'77.1887', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Jharkhand (state_id = 10)
            ['name'=>'Ranchi', 'state_id'=>10, 'latitude'=>'23.3441', 'longitude'=>'85.3096', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Jamshedpur', 'state_id'=>10, 'latitude'=>'22.8046', 'longitude'=>'86.2029', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Dhanbad', 'state_id'=>10, 'latitude'=>'23.7957', 'longitude'=>'86.4304', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Karnataka (state_id = 11)
            ['name'=>'Bengaluru', 'state_id'=>11, 'latitude'=>'12.9716', 'longitude'=>'77.5946', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Mysuru', 'state_id'=>11, 'latitude'=>'12.2958', 'longitude'=>'76.6394', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Hubli', 'state_id'=>11, 'latitude'=>'15.3647', 'longitude'=>'75.1240', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Mangaluru', 'state_id'=>11, 'latitude'=>'12.9141', 'longitude'=>'74.8560', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Kerala (state_id = 12)
            ['name'=>'Thiruvananthapuram', 'state_id'=>12, 'latitude'=>'8.5241', 'longitude'=>'76.9366', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kochi', 'state_id'=>12, 'latitude'=>'9.9312', 'longitude'=>'76.2673', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kozhikode', 'state_id'=>12, 'latitude'=>'11.2588', 'longitude'=>'75.7804', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Thrissur', 'state_id'=>12, 'latitude'=>'10.5276', 'longitude'=>'76.2144', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Madhya Pradesh (state_id = 13)
            ['name'=>'Bhopal', 'state_id'=>13, 'latitude'=>'23.2599', 'longitude'=>'77.4126', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Indore', 'state_id'=>13, 'latitude'=>'22.7196', 'longitude'=>'75.8577', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Gwalior', 'state_id'=>13, 'latitude'=>'26.2183', 'longitude'=>'78.1828', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Jabalpur', 'state_id'=>13, 'latitude'=>'23.1815', 'longitude'=>'79.9864', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Maharashtra (state_id = 14)
            ['name'=>'Mumbai', 'state_id'=>14, 'latitude'=>'19.0760', 'longitude'=>'72.8777', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Pune', 'state_id'=>14, 'latitude'=>'18.5204', 'longitude'=>'73.8567', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Nagpur', 'state_id'=>14, 'latitude'=>'21.1458', 'longitude'=>'79.0882', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Nashik', 'state_id'=>14, 'latitude'=>'19.9975', 'longitude'=>'73.7898', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Aurangabad', 'state_id'=>14, 'latitude'=>'19.8762', 'longitude'=>'75.3433', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Manipur (state_id = 15)
            ['name'=>'Imphal', 'state_id'=>15, 'latitude'=>'24.8170', 'longitude'=>'93.9368', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Meghalaya (state_id = 16)
            ['name'=>'Shillong', 'state_id'=>16, 'latitude'=>'25.5788', 'longitude'=>'91.8933', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Mizoram (state_id = 17)
            ['name'=>'Aizawl', 'state_id'=>17, 'latitude'=>'23.7271', 'longitude'=>'92.7176', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Nagaland (state_id = 18)
            ['name'=>'Kohima', 'state_id'=>18, 'latitude'=>'25.6751', 'longitude'=>'94.1086', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Dimapur', 'state_id'=>18, 'latitude'=>'25.9044', 'longitude'=>'93.7267', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Odisha (state_id = 19)
            ['name'=>'Bhubaneswar', 'state_id'=>19, 'latitude'=>'20.2961', 'longitude'=>'85.8245', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Cuttack', 'state_id'=>19, 'latitude'=>'20.4625', 'longitude'=>'85.8828', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Rourkela', 'state_id'=>19, 'latitude'=>'22.2604', 'longitude'=>'84.8536', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Berhampur', 'state_id'=>19, 'latitude'=>'19.3149', 'longitude'=>'84.7941', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Sambalpur', 'state_id'=>19, 'latitude'=>'21.4669', 'longitude'=>'83.9812', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Puri', 'state_id'=>19, 'latitude'=>'19.8135', 'longitude'=>'85.8312', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Balasore', 'state_id'=>19, 'latitude'=>'21.4942', 'longitude'=>'86.9336', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Baripada', 'state_id'=>19, 'latitude'=>'21.9347', 'longitude'=>'86.7337', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Jharsuguda', 'state_id'=>19, 'latitude'=>'21.8558', 'longitude'=>'84.0058', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Punjab (state_id = 20)
            ['name'=>'Chandigarh', 'state_id'=>20, 'latitude'=>'30.7333', 'longitude'=>'76.7794', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Ludhiana', 'state_id'=>20, 'latitude'=>'30.9000', 'longitude'=>'75.8573', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Amritsar', 'state_id'=>20, 'latitude'=>'31.6340', 'longitude'=>'74.8723', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Jalandhar', 'state_id'=>20, 'latitude'=>'31.3260', 'longitude'=>'75.5762', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Patiala', 'state_id'=>20, 'latitude'=>'30.3398', 'longitude'=>'76.3869', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bathinda', 'state_id'=>20, 'latitude'=>'30.2110', 'longitude'=>'74.9455', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Mohali', 'state_id'=>20, 'latitude'=>'30.7046', 'longitude'=>'76.7179', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Firozpur', 'state_id'=>20, 'latitude'=>'30.9320', 'longitude'=>'74.6150', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Pathankot', 'state_id'=>20, 'latitude'=>'32.2746', 'longitude'=>'75.6521', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Moga', 'state_id'=>20, 'latitude'=>'30.8158', 'longitude'=>'75.1711', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Abohar', 'state_id'=>20, 'latitude'=>'30.1204', 'longitude'=>'74.1995', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Malerkotla', 'state_id'=>20, 'latitude'=>'30.5281', 'longitude'=>'75.8792', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Khanna', 'state_id'=>20, 'latitude'=>'30.7058', 'longitude'=>'76.2219', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Phagwara', 'state_id'=>20, 'latitude'=>'31.2244', 'longitude'=>'75.7739', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Muktsar', 'state_id'=>20, 'latitude'=>'30.4762', 'longitude'=>'74.5161', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Barnala', 'state_id'=>20, 'latitude'=>'30.3781', 'longitude'=>'75.5462', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Rajpura', 'state_id'=>20, 'latitude'=>'30.4840', 'longitude'=>'76.5934', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Hoshiarpur', 'state_id'=>20, 'latitude'=>'31.5382', 'longitude'=>'75.9113', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kapurthala', 'state_id'=>20, 'latitude'=>'31.3800', 'longitude'=>'75.3800', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Sangrur', 'state_id'=>20, 'latitude'=>'30.2458', 'longitude'=>'75.8421', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Rourkela', 'state_id'=>19, 'latitude'=>'22.2604', 'longitude'=>'84.8536', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Punjab (state_id = 20)
            ['name'=>'Chandigarh', 'state_id'=>20, 'latitude'=>'30.7333', 'longitude'=>'76.7794', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Ludhiana', 'state_id'=>20, 'latitude'=>'30.9000', 'longitude'=>'75.8573', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Amritsar', 'state_id'=>20, 'latitude'=>'31.6340', 'longitude'=>'74.8723', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Jalandhar', 'state_id'=>20, 'latitude'=>'31.3260', 'longitude'=>'75.5762', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Rajasthan (state_id = 21)
            ['name'=>'Jaipur', 'state_id'=>21, 'latitude'=>'26.9124', 'longitude'=>'75.7873', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Jodhpur', 'state_id'=>21, 'latitude'=>'26.2389', 'longitude'=>'73.0243', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Udaipur', 'state_id'=>21, 'latitude'=>'24.5854', 'longitude'=>'73.7125', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kota', 'state_id'=>21, 'latitude'=>'25.2138', 'longitude'=>'75.8648', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Sikkim (state_id = 22)
            ['name'=>'Gangtok', 'state_id'=>22, 'latitude'=>'27.3389', 'longitude'=>'88.6065', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Tamil Nadu (state_id = 23)
            ['name'=>'Chennai', 'state_id'=>23, 'latitude'=>'13.0827', 'longitude'=>'80.2707', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Coimbatore', 'state_id'=>23, 'latitude'=>'11.0168', 'longitude'=>'76.9558', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Madurai', 'state_id'=>23, 'latitude'=>'9.9252', 'longitude'=>'78.1198', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Tiruchirappalli', 'state_id'=>23, 'latitude'=>'10.7905', 'longitude'=>'78.7047', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Salem', 'state_id'=>23, 'latitude'=>'11.6643', 'longitude'=>'78.1460', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Telangana (state_id = 24)
            ['name'=>'Hyderabad', 'state_id'=>24, 'latitude'=>'17.3850', 'longitude'=>'78.4867', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Warangal', 'state_id'=>24, 'latitude'=>'17.9689', 'longitude'=>'79.5941', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Nizamabad', 'state_id'=>24, 'latitude'=>'18.6725', 'longitude'=>'78.0941', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Tripura (state_id = 25)
            ['name'=>'Agartala', 'state_id'=>25, 'latitude'=>'23.8315', 'longitude'=>'91.2868', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Uttar Pradesh (state_id = 26)
            ['name'=>'Lucknow', 'state_id'=>26, 'latitude'=>'26.8467', 'longitude'=>'80.9462', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kanpur', 'state_id'=>26, 'latitude'=>'26.4499', 'longitude'=>'80.3319', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Agra', 'state_id'=>26, 'latitude'=>'27.1767', 'longitude'=>'78.0081', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Varanasi', 'state_id'=>26, 'latitude'=>'25.3176', 'longitude'=>'82.9739', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Meerut', 'state_id'=>26, 'latitude'=>'28.9845', 'longitude'=>'77.7064', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Allahabad', 'state_id'=>26, 'latitude'=>'25.4358', 'longitude'=>'81.8463', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Uttarakhand (state_id = 27)
            ['name'=>'Dehradun', 'state_id'=>27, 'latitude'=>'30.3165', 'longitude'=>'78.0322', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Haridwar', 'state_id'=>27, 'latitude'=>'29.9457', 'longitude'=>'78.1642', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Nainital', 'state_id'=>27, 'latitude'=>'29.3803', 'longitude'=>'79.4636', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // West Bengal (state_id = 28)
            ['name'=>'Kolkata', 'state_id'=>28, 'latitude'=>'22.5726', 'longitude'=>'88.3639', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Howrah', 'state_id'=>28, 'latitude'=>'22.5958', 'longitude'=>'88.2636', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Durgapur', 'state_id'=>28, 'latitude'=>'23.5204', 'longitude'=>'87.3119', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Siliguri', 'state_id'=>28, 'latitude'=>'26.7271', 'longitude'=>'88.3953', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],




            // Rajasthan (state_id = 21)
            ['name'=>'Jaipur', 'state_id'=>21, 'latitude'=>'26.9124', 'longitude'=>'75.7873', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Jodhpur', 'state_id'=>21, 'latitude'=>'26.2389', 'longitude'=>'73.0243', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Udaipur', 'state_id'=>21, 'latitude'=>'24.5854', 'longitude'=>'73.7125', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kota', 'state_id'=>21, 'latitude'=>'25.2138', 'longitude'=>'75.8648', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Ajmer', 'state_id'=>21, 'latitude'=>'26.4499', 'longitude'=>'74.6399', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bikaner', 'state_id'=>21, 'latitude'=>'28.0229', 'longitude'=>'73.3119', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Alwar', 'state_id'=>21, 'latitude'=>'27.5530', 'longitude'=>'76.6346', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bharatpur', 'state_id'=>21, 'latitude'=>'27.2152', 'longitude'=>'77.4977', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Sikar', 'state_id'=>21, 'latitude'=>'27.6094', 'longitude'=>'75.1399', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bhilwara', 'state_id'=>21, 'latitude'=>'25.3407', 'longitude'=>'74.6269', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Pali', 'state_id'=>21, 'latitude'=>'25.7711', 'longitude'=>'73.3234', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Sri Ganganagar', 'state_id'=>21, 'latitude'=>'29.9038', 'longitude'=>'73.8772', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kishangarh', 'state_id'=>21, 'latitude'=>'26.5820', 'longitude'=>'74.8644', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Baran', 'state_id'=>21, 'latitude'=>'25.1011', 'longitude'=>'76.5132', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Dhaulpur', 'state_id'=>21, 'latitude'=>'26.6947', 'longitude'=>'77.8881', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Tonk', 'state_id'=>21, 'latitude'=>'26.1693', 'longitude'=>'75.7849', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Beawar', 'state_id'=>21, 'latitude'=>'26.1020', 'longitude'=>'74.3200', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Hanumangarh', 'state_id'=>21, 'latitude'=>'29.5814', 'longitude'=>'74.3089', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Sikkim (state_id = 22)
            ['name'=>'Gangtok', 'state_id'=>22, 'latitude'=>'27.3389', 'longitude'=>'88.6065', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Namchi', 'state_id'=>22, 'latitude'=>'27.1668', 'longitude'=>'88.3639', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Geyzing', 'state_id'=>22, 'latitude'=>'27.4833', 'longitude'=>'88.2667', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Mangan', 'state_id'=>22, 'latitude'=>'27.5167', 'longitude'=>'88.5333', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Tamil Nadu (state_id = 23)
            ['name'=>'Chennai', 'state_id'=>23, 'latitude'=>'13.0827', 'longitude'=>'80.2707', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Coimbatore', 'state_id'=>23, 'latitude'=>'11.0168', 'longitude'=>'76.9558', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Madurai', 'state_id'=>23, 'latitude'=>'9.9252', 'longitude'=>'78.1198', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Tiruchirappalli', 'state_id'=>23, 'latitude'=>'10.7905', 'longitude'=>'78.7047', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Salem', 'state_id'=>23, 'latitude'=>'11.6643', 'longitude'=>'78.1460', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Tirunelveli', 'state_id'=>23, 'latitude'=>'8.7139', 'longitude'=>'77.7567', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Tiruppur', 'state_id'=>23, 'latitude'=>'11.1085', 'longitude'=>'77.3411', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Vellore', 'state_id'=>23, 'latitude'=>'12.9165', 'longitude'=>'79.1325', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Erode', 'state_id'=>23, 'latitude'=>'11.3410', 'longitude'=>'77.7172', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Thoothukkudi', 'state_id'=>23, 'latitude'=>'8.7642', 'longitude'=>'78.1348', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Dindigul', 'state_id'=>23, 'latitude'=>'10.3673', 'longitude'=>'77.9803', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Thanjavur', 'state_id'=>23, 'latitude'=>'10.7870', 'longitude'=>'79.1378', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Ranipet', 'state_id'=>23, 'latitude'=>'12.9249', 'longitude'=>'79.3308', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Sivakasi', 'state_id'=>23, 'latitude'=>'9.4581', 'longitude'=>'77.7906', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Karur', 'state_id'=>23, 'latitude'=>'10.9601', 'longitude'=>'78.0766', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Udhagamandalam', 'state_id'=>23, 'latitude'=>'11.4064', 'longitude'=>'76.6932', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Hosur', 'state_id'=>23, 'latitude'=>'12.7409', 'longitude'=>'77.8253', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Nagercoil', 'state_id'=>23, 'latitude'=>'8.1790', 'longitude'=>'77.4338', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kanchipuram', 'state_id'=>23, 'latitude'=>'12.8342', 'longitude'=>'79.7036', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kumarakonam', 'state_id'=>23, 'latitude'=>'10.9601', 'longitude'=>'79.3881', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Pudukkottai', 'state_id'=>23, 'latitude'=>'10.3833', 'longitude'=>'78.8200', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Ambur', 'state_id'=>23, 'latitude'=>'12.7918', 'longitude'=>'78.7162', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Telangana (state_id = 24)
            ['name'=>'Hyderabad', 'state_id'=>24, 'latitude'=>'17.3850', 'longitude'=>'78.4867', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Warangal', 'state_id'=>24, 'latitude'=>'17.9689', 'longitude'=>'79.5941', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Nizamabad', 'state_id'=>24, 'latitude'=>'18.6725', 'longitude'=>'78.0941', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Khammam', 'state_id'=>24, 'latitude'=>'17.2473', 'longitude'=>'80.1514', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Karimnagar', 'state_id'=>24, 'latitude'=>'18.4386', 'longitude'=>'79.1288', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Ramagundam', 'state_id'=>24, 'latitude'=>'18.7537', 'longitude'=>'79.4740', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Mahbubnagar', 'state_id'=>24, 'latitude'=>'16.7393', 'longitude'=>'77.9974', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Nalgonda', 'state_id'=>24, 'latitude'=>'17.0542', 'longitude'=>'79.2673', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Adilabad', 'state_id'=>24, 'latitude'=>'19.6718', 'longitude'=>'78.5362', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Suryapet', 'state_id'=>24, 'latitude'=>'17.1404', 'longitude'=>'79.6190', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Miryalaguda', 'state_id'=>24, 'latitude'=>'16.8747', 'longitude'=>'79.5664', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Jagtial', 'state_id'=>24, 'latitude'=>'18.7898', 'longitude'=>'78.9196', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Mancherial', 'state_id'=>24, 'latitude'=>'18.8728', 'longitude'=>'79.4589', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kamareddy', 'state_id'=>24, 'latitude'=>'18.3219', 'longitude'=>'78.3419', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Siddipet', 'state_id'=>24, 'latitude'=>'18.1018', 'longitude'=>'78.8548', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Tripura (state_id = 25)
            ['name'=>'Agartala', 'state_id'=>25, 'latitude'=>'23.8315', 'longitude'=>'91.2868', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Dharmanagar', 'state_id'=>25, 'latitude'=>'24.3667', 'longitude'=>'92.1667', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Udaipur', 'state_id'=>25, 'latitude'=>'23.5333', 'longitude'=>'91.4833', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kailashahar', 'state_id'=>25, 'latitude'=>'24.3333', 'longitude'=>'92.0000', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Belonia', 'state_id'=>25, 'latitude'=>'23.2500', 'longitude'=>'91.4500', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Khowai', 'state_id'=>25, 'latitude'=>'24.0667', 'longitude'=>'91.6000', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Ambassa', 'state_id'=>25, 'latitude'=>'23.9333', 'longitude'=>'91.8500', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Teliamura', 'state_id'=>25, 'latitude'=>'23.4667', 'longitude'=>'91.3667', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Uttar Pradesh (state_id = 26)
            ['name'=>'Lucknow', 'state_id'=>26, 'latitude'=>'26.8467', 'longitude'=>'80.9462', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kanpur', 'state_id'=>26, 'latitude'=>'26.4499', 'longitude'=>'80.3319', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Agra', 'state_id'=>26, 'latitude'=>'27.1767', 'longitude'=>'78.0081', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Varanasi', 'state_id'=>26, 'latitude'=>'25.3176', 'longitude'=>'82.9739', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Meerut', 'state_id'=>26, 'latitude'=>'28.9845', 'longitude'=>'77.7064', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Allahabad', 'state_id'=>26, 'latitude'=>'25.4358', 'longitude'=>'81.8463', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bareilly', 'state_id'=>26, 'latitude'=>'28.3670', 'longitude'=>'79.4304', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Aligarh', 'state_id'=>26, 'latitude'=>'27.8974', 'longitude'=>'78.0880', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Moradabad', 'state_id'=>26, 'latitude'=>'28.8386', 'longitude'=>'78.7733', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Saharanpur', 'state_id'=>26, 'latitude'=>'29.9680', 'longitude'=>'77.5552', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Gorakhpur', 'state_id'=>26, 'latitude'=>'26.7606', 'longitude'=>'83.3732', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Noida', 'state_id'=>26, 'latitude'=>'28.5355', 'longitude'=>'77.3910', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Firozabad', 'state_id'=>26, 'latitude'=>'27.1592', 'longitude'=>'78.3957', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Jhansi', 'state_id'=>26, 'latitude'=>'25.4484', 'longitude'=>'78.5685', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Muzaffarnagar', 'state_id'=>26, 'latitude'=>'29.4727', 'longitude'=>'77.7085', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Mathura', 'state_id'=>26, 'latitude'=>'27.4924', 'longitude'=>'77.6737', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Rampur', 'state_id'=>26, 'latitude'=>'28.8152', 'longitude'=>'79.0250', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Shahjahanpur', 'state_id'=>26, 'latitude'=>'27.8881', 'longitude'=>'79.9063', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Farrukhabad', 'state_id'=>26, 'latitude'=>'27.3929', 'longitude'=>'79.5804', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Hapur', 'state_id'=>26, 'latitude'=>'28.7306', 'longitude'=>'77.7750', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Ghaziabad', 'state_id'=>26, 'latitude'=>'28.6692', 'longitude'=>'77.4538', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Orai', 'state_id'=>26, 'latitude'=>'25.9897', 'longitude'=>'79.4504', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bahraich', 'state_id'=>26, 'latitude'=>'27.5742', 'longitude'=>'81.5947', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Modinagar', 'state_id'=>26, 'latitude'=>'28.9167', 'longitude'=>'77.6167', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Unnao', 'state_id'=>26, 'latitude'=>'26.5464', 'longitude'=>'80.4879', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Jaunpur', 'state_id'=>26, 'latitude'=>'25.7478', 'longitude'=>'82.6869', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Lakhimpur', 'state_id'=>26, 'latitude'=>'27.9479', 'longitude'=>'80.7781', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Hathras', 'state_id'=>26, 'latitude'=>'27.5974', 'longitude'=>'78.0504', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Sitapur', 'state_id'=>26, 'latitude'=>'27.5669', 'longitude'=>'80.6747', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Lalitpur', 'state_id'=>26, 'latitude'=>'24.6854', 'longitude'=>'78.4278', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Pilibhit', 'state_id'=>26, 'latitude'=>'28.6315', 'longitude'=>'79.8042', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Barabanki', 'state_id'=>26, 'latitude'=>'26.9254', 'longitude'=>'81.2047', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Khurja', 'state_id'=>26, 'latitude'=>'28.2513', 'longitude'=>'77.8556', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Gonda', 'state_id'=>26, 'latitude'=>'27.1333', 'longitude'=>'81.9667', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Mainpuri', 'state_id'=>26, 'latitude'=>'27.2356', 'longitude'=>'79.0278', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Lalitpur', 'state_id'=>26, 'latitude'=>'24.6854', 'longitude'=>'78.4278', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Etah', 'state_id'=>26, 'latitude'=>'27.6333', 'longitude'=>'78.6667', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Deoria', 'state_id'=>26, 'latitude'=>'26.5024', 'longitude'=>'83.7791', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Ujhani', 'state_id'=>26, 'latitude'=>'28.0167', 'longitude'=>'79.0167', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Ghazipur', 'state_id'=>26, 'latitude'=>'25.5881', 'longitude'=>'83.5775', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Sultanpur', 'state_id'=>26, 'latitude'=>'26.2647', 'longitude'=>'82.0739', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Azamgarh', 'state_id'=>26, 'latitude'=>'26.0685', 'longitude'=>'83.1836', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bijnor', 'state_id'=>26, 'latitude'=>'29.3731', 'longitude'=>'78.1364', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Najibabad', 'state_id'=>26, 'latitude'=>'29.6133', 'longitude'=>'78.3433', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Sikandrabad', 'state_id'=>26, 'latitude'=>'28.4500', 'longitude'=>'77.7000', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Chandausi', 'state_id'=>26, 'latitude'=>'28.4667', 'longitude'=>'78.7833', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Akbarpur', 'state_id'=>26, 'latitude'=>'26.4167', 'longitude'=>'82.5333', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Ballia', 'state_id'=>26, 'latitude'=>'25.7522', 'longitude'=>'84.1497', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Tanda', 'state_id'=>26, 'latitude'=>'26.5500', 'longitude'=>'82.6500', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Greater Noida', 'state_id'=>26, 'latitude'=>'28.4744', 'longitude'=>'77.5040', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Shikohabad', 'state_id'=>26, 'latitude'=>'27.1167', 'longitude'=>'78.5833', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Shamli', 'state_id'=>26, 'latitude'=>'29.4500', 'longitude'=>'77.3167', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Awagarh', 'state_id'=>26, 'latitude'=>'27.7333', 'longitude'=>'78.0833', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kasganj', 'state_id'=>26, 'latitude'=>'27.8000', 'longitude'=>'78.6500', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // Uttarakhand (state_id = 27)
            ['name'=>'Dehradun', 'state_id'=>27, 'latitude'=>'30.3165', 'longitude'=>'78.0322', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Haridwar', 'state_id'=>27, 'latitude'=>'29.9457', 'longitude'=>'78.1642', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Nainital', 'state_id'=>27, 'latitude'=>'29.3803', 'longitude'=>'79.4636', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Roorkee', 'state_id'=>27, 'latitude'=>'29.8543', 'longitude'=>'77.8880', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Haldwani-cum-Kathgodam', 'state_id'=>27, 'latitude'=>'29.2183', 'longitude'=>'79.5130', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Rudrapur', 'state_id'=>27, 'latitude'=>'28.9845', 'longitude'=>'79.4077', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kashipur', 'state_id'=>27, 'latitude'=>'29.2155', 'longitude'=>'78.9564', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Rishikesh', 'state_id'=>27, 'latitude'=>'30.0869', 'longitude'=>'78.2676', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Pithoragarh', 'state_id'=>27, 'latitude'=>'29.5833', 'longitude'=>'80.2167', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Ramnagar', 'state_id'=>27, 'latitude'=>'29.3947', 'longitude'=>'79.1281', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Mussoorie', 'state_id'=>27, 'latitude'=>'30.4598', 'longitude'=>'78.0664', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Tehri', 'state_id'=>27, 'latitude'=>'30.3833', 'longitude'=>'78.4833', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Pauri', 'state_id'=>27, 'latitude'=>'30.1500', 'longitude'=>'78.7833', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Almora', 'state_id'=>27, 'latitude'=>'29.5971', 'longitude'=>'79.6593', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bageshwar', 'state_id'=>27, 'latitude'=>'29.8667', 'longitude'=>'79.7667', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],

            // West Bengal (state_id = 28)
            ['name'=>'Kolkata', 'state_id'=>28, 'latitude'=>'22.5726', 'longitude'=>'88.3639', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Howrah', 'state_id'=>28, 'latitude'=>'22.5958', 'longitude'=>'88.2636', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Durgapur', 'state_id'=>28, 'latitude'=>'23.5204', 'longitude'=>'87.3119', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Siliguri', 'state_id'=>28, 'latitude'=>'26.7271', 'longitude'=>'88.3953', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Asansol', 'state_id'=>28, 'latitude'=>'23.6739', 'longitude'=>'86.9524', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Malda', 'state_id'=>28, 'latitude'=>'25.0000', 'longitude'=>'88.1333', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Baharampur', 'state_id'=>28, 'latitude'=>'24.1000', 'longitude'=>'88.2500', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Habra', 'state_id'=>28, 'latitude'=>'22.8333', 'longitude'=>'88.6333', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Kharagpur', 'state_id'=>28, 'latitude'=>'22.3460', 'longitude'=>'87.2320', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Shantipur', 'state_id'=>28, 'latitude'=>'23.2500', 'longitude'=>'88.4333', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Dankuni', 'state_id'=>28, 'latitude'=>'22.6667', 'longitude'=>'88.2833', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Dhulian', 'state_id'=>28, 'latitude'=>'24.6833', 'longitude'=>'87.9500', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Ranaghat', 'state_id'=>28, 'latitude'=>'23.1833', 'longitude'=>'88.5833', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Haldia', 'state_id'=>28, 'latitude'=>'22.0333', 'longitude'=>'88.0667', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Raiganj', 'state_id'=>28, 'latitude'=>'25.6167', 'longitude'=>'88.1167', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Krishnanagar', 'state_id'=>28, 'latitude'=>'23.4000', 'longitude'=>'88.5000', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Nabadwip', 'state_id'=>28, 'latitude'=>'23.4167', 'longitude'=>'88.3667', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Medinipur', 'state_id'=>28, 'latitude'=>'22.4333', 'longitude'=>'87.3333', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Jalpaiguri', 'state_id'=>28, 'latitude'=>'26.5167', 'longitude'=>'88.7333', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Balurghat', 'state_id'=>28, 'latitude'=>'25.2167', 'longitude'=>'88.7667', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Basirhat', 'state_id'=>28, 'latitude'=>'22.6667', 'longitude'=>'88.9000', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bankura', 'state_id'=>28, 'latitude'=>'23.2333', 'longitude'=>'87.0667', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Chakdaha', 'state_id'=>28, 'latitude'=>'23.0833', 'longitude'=>'88.5167', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Darjeeling', 'state_id'=>28, 'latitude'=>'27.0333', 'longitude'=>'88.2667', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Alipurduar', 'state_id'=>28, 'latitude'=>'26.4833', 'longitude'=>'89.5333', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Purulia', 'state_id'=>28, 'latitude'=>'23.3333', 'longitude'=>'86.3667', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Jangipur', 'state_id'=>28, 'latitude'=>'24.4667', 'longitude'=>'88.0833', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bolpur', 'state_id'=>28, 'latitude'=>'23.6667', 'longitude'=>'87.7167', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Bangaon', 'state_id'=>28, 'latitude'=>'23.0500', 'longitude'=>'88.8333', 'timezone'=>'Asia/Kolkata', 'status'=>'1'],
            ['name'=>'Cooch Behar', 'state_id'=>28, 'latitude'=>'26.3167', 'longitude'=>'89.4500', 'timezone'=>'Asia/Kolkata', 'status'=>'1']
        ];

        foreach ($cities as $c) {
            City::updateOrCreate(
                ['name' => $c['name'], 'state_id' => $c['state_id']],
                $c
            );
        }
    }
}
