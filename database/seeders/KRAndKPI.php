<?php

namespace Database\Seeders;

use App\Models\KeyPerformanceIndicator;
use App\Models\KeyResultArea;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class KRAndKPI extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // start with buss
        $data = array(
            'Quality Assuarance Supervisor - Foodscape' => array(
                'Effective resource management' => array(
                    '100% implementation of quarterly internal audits) and follow up on CAP’s arising from the same.'
                ),
                'Audits' => array(
                    '100% implementation of corrective actions resulting from audits and failed micro-analysis and ATP swab results.'
                ),
                'Traceability' => array(
                    '100% traceability score within 2 hours during monthly traceability challenges'
                ),
                'Training' => array(
                    '100% compliance to food safety training schedules and induction training.'
                ),
                'Effective safety leadership & communication' => array(
                    'Reduced employee turnover & improved employee effectiveness.'
                ),
                'ATP & Micro testing of food , water & environmental swabs' => array(
                    '100% follow up on filled FSR’s (Food safety reports) issued to suppliers for non-conformance arising to supplied products'
                ),
            ),
            'Buss Person' => array(
                'NPS' => array(
                    'Ensure that the sops for restaurant hygiene are maintained and consistently adhered to in accordance to food safety requirements.'
                ),
                'Food Safety' => array(
                    'Cleaning, clearing and organizing table condiments.'
                ),
                'Integrity' => array(
                    'Attend to the tables and guarantee compliance to cleanliness standards'
                ),
            ),
            'Cashier' => array(
                'Food safety' => array(
                    'Ensure quality food and drinks are served to all guests upon dispatch'
                ),
                'Integrity' => array(
                    'Ensure all take away food or drinks are properly packed/ covered in accordance with the Food Safety and Hygiene standards.'
                ),
                'NPS' => array(
                    'Pleasantly dealing with customers to ensure satisfaction'
                ),
                'Margins' => array(
                    'Ensure all company money is intact as transacted at all times and all transactions accompanied with  official receipts',
                    'Ensure proper packaging is done by organizing mis-en-place for take away orders'
                )
            ),
            'Hostess' => array(
                'Food Safety' => array(
                    'Ensure all guests are sat immediately they walk into the restaurant.'
                ),
                'NPS' => array(
                    'Inform every guest on any new specials available in the restaurant.'
                ),
                'Integrity' => array(
                    'Adhere to laid down company policies on grooming.'
                ),
                'L4L Sales' => array(
                    'Tend to special need guests and requests',
                    'Ensure all cleaning cloths are well soaked in sanitizers.',
                    'Share guests’ feedback to manager.'
                )
            ),
            'Cook' => array(
                'Food Safety' => array(
                    'Ensure hygiene of the highest level is achieved in the kitchen'
                ),
                'NPS' => array(
                    'Ensure that the food produced is of high quality and standard'
                ),
                'Integrity' => array(
                    'Ensure that all food items are correctly stored and all SOPs are followed'
                ),
                'Station management' => array(
                    'Ensure that all cooking resources are used correctly'
                )
            ),
            'Cook II' => array(
                'Food Safety' => array(
                    'Ensure hygiene of the highest level is achieved in the kitchen'
                ),
                'NPS' => array(
                    'Ensure that the food produced is of high quality and standard'
                ),
                'Integrity' => array(
                    'Ensure that all food items are correctly stored and all SOPs are followed'
                ),
                'Station management' => array(
                    'Ensure that all cooking resources are used correctly'
                )
            ),
            'Cook I' => array(
                'Food Safety' => array(
                    'Ensure hygiene of the highest level is achieved in the kitchen'
                ),
                'NPS' => array(
                    'Ensure that the food produced is of high quality and standard'
                ),
                'Integrity' => array(
                    'Ensure that all food items are correctly stored and all SOPs are followed'
                ),
                'Station management' => array(
                    'Ensure that all cooking resources are used correctly'
                )
            ),
            'Steward' => array(
                'Food Safety' => array(
                    'In charge of kitchen hygiene'
                ),
                'NPS' => array(
                    'Ensure that guest and staff toilets are clean and well stocked'
                ),
                'Integrity' => array(
                    'Proper handling and cleaning of utensils and crockery'
                ),
                'Station management' => array(
                    'Ensure that all detergents are used correctly'
                )
            ),
            'Rider' => array(
                'Food Safety' => array(
                    'Ensure effective communication'
                ),
                'NPS/ Timely delivery' => array(
                    'Ensure that all transaction are completed accurately'
                ),
                'Accident/ Incident Rate' => array(
                    'Ensure hygiene of the highest level is achieved during the delivery process'
                ),
                'Compliance to Traffic Act and Regulations' => array()
            ),
            'Head Barman' => array(
                'Food Safety' => array(
                    'Ensure all guests are sat immediately they walk into the restaurant.',
                    'Inform every guest on any new specials available in the restaurant.'
                ),
                'NPS' => array(
                    'Inform every guest on any new specials available in the restaurant.'
                ),
                'Integrity' => array(
                    'Tend to special need guests and requests'
                ),
                'L4L Sales' => array(
                    'Ensure all cleaning cloths are well soaked in sanitizers',
                    'Share guests’ feedback to manager',
                    'Check identification of the guest to make sure they meet age requirements for purchase of alcohol and tobacco products',
                    'Mix drinks, cocktails and other bar beverages as ordered and in compliance with hotel standard drink recipe.'
                )
            ),
            'Barman' => array(
                'Food Safety' => array(
                    'Ensure all guests are sat immediately they walk into the restaurant.',
                    'Inform every guest on any new specials available in the restaurant.'
                ),
                'NPS' => array(
                    'Adhere to laid down company policies on grooming.'
                ),
                'Integrity' => array(
                    'Tend to special need guests and requests'
                ),
                'L4L Sales' => array(
                    'Ensure all cleaning cloths are well soaked in sanitizers',
                    'Share guests’ feedback to manager',
                    'Check identification of the guest to make sure they meet age requirements for purchase of alcohol and tobacco products',
                    'Mix drinks, cocktails and other bar beverages as ordered and in compliance with hotel standard drink recipe.'
                )
            ),
            'Assistant Branch Chef' => array(
                'Food Safety' => array(
                    'Proper handling of machines'
                ),
                'Margins' => array(
                    'Supervises cooks and guides them on operations geared towards food quality'
                ),
                'NPS' => array(
                    'Training new cook on food production as per the set standards'
                ),
                'Integrity' => array(
                    'In charge of the kitchen in absence of the chef',
                    'Ensure efficient food production to achieve the budgeted cost of sales'
                ),
                'L4L Sales' => array(
                    'Ensure the highest level of hygiene is achieved in line with food safety standards',
                )
            ),
            'Valet' => array(
                'Cleanness of the parking' => array(
                    'Enhancing parking service level'
                ),
                'Planning and layout of the parking' => array(
                    'Assisting customers in the parking'
                ),
                'Guest satisfaction' => array(
                    'Security of guest cars at the parking.',
                    'Transparency with the customers safety of cars.',
                    'Impression feedback by customers.',
                    'Risk management.'
                )
            ),
            'Wait Staff' => array(
                'NPS' => array(
                    'Meet, greet and sit guests in a timely manner.'
                ),
                'Food Safety' => array(
                    'Taking food and beverage orders from customers and ensure prompt service delivery.'
                ),
                'Integrity' => array(
                    'Cleaning, clearing and organizing table condiments.'
                ),
                'Sales per person' => array(
                    'Presenting bills and give back correct change to the guest within the shortest time possible.'
                ),
                'Station management' => array(
                    'Assist guests on easy menu navigation.',
                    'Attend to the tables and guarantee compliance to cleanliness standards.',
                    'Check the quality of the final servings and resolve any issues accordingly based on recommended food and beverage standards.'
                )
            ),
            'Branch Manager' => array(
                'Food safety' => array(
                    'Enforce operational practices of the branch, making sure it runs smoothly and complies with food safety requirements'
                ),
                'Integrity' => array(
                    'Training of Branch staff and coordinate their progress to ensure the set procedures are adhered to.'
                ),
                'NPS' => array(
                    'Ensure guest’s satisfaction is met through consistently auditing the branch operations on a daily basis.'
                ),
                'L4L sales' => array(
                    'Ensure that the par levels of both Crockery and Food/non-food items are adhered and encourage suggestive selling to maximize on revenue.'
                ),
                'Margins' => array(
                    'Directly involved in driving & analyzing the stores performance and ensure that the set budget is achieved on operational COS, sales and labor optimization.'
                )
            ),
            'Crew Supervisor' => array(
                'Sales, Margins' => array(
                    'Directly involved in driving and analyzing the stores performance and ensure that the set budget is achieved on operational Cost of Sales, sales and labor optimization'
                ),
                'Employee engagement, Staff retention, Osha' => array(
                    'Training of Branch staff and coordinates their progress to ensure the set procedures are adhered to.'
                ),
                'NPS (Food safety, Coffee Excellence)' => array(
                    'Ensure that guest’s satisfaction is met through consistently auditing the branch operations on a daily basis.',
                    'Enforce operational practices of the branch in making sure each unit runs smoothly and complies with food safety requirements.',
                    'Ensure that the par levels of food/nonfood items are adhered to and encourage suggestive selling to maximize on revenue.'
                ),
            ),
            'Crew Member' => array(
                'Food Safety' => array(
                    'Ensure that the SOPs for restaurant hygiene are maintained and consistently adhered to in accordance to food safety requirements'
                ),
                'Net Promoter Score' => array(
                    'Attend to the tables and guarantee compliance to cleanliness standards'
                ),
                'Integrity' => array(
                    'Ensure all company money is intact as transacted at all times and all transactions accompanied with  official receipts'
                ),
            ),
            'Customer Service Associate' => array(
                'Number of guest complaints in relation to service/shop cleanliness/topping stock outs' => array(
                    'Engages actively with the guests in line with the trained standard operation procedures (SOPs) in order to enhance their experience.'
                ),
                'Number of suspended checks held in the system' => array(
                    'Cleans the shop in line with cleaning SOPs in order to provide a hygienic eating area for the guests.'
                ),
                'Amount of till shorts and payment method shorts' => array(
                    'Refills the fruits and sweet toppings in a timely manner to ensure that the guest has all available toppings.',
                    'Handles payments at the till according to SOPs to ensure accurate cash handling and avoidance of shorts.',
                    'Takes FOH stock accurately to provide correct visibility on consumption and stocks held.'
                ),
            ),
            'Senior Barista' => array(
                'NPS' => array(
                    'Ensures that all food and beverages produced at the barista counter are in accordance with the set S.O.Ps'
                ),
                'Food Safety' => array(
                    'Schedules and documents the training programme for each trainee and provides assessment reports prior to the confirmation of the trainee to a barista post.',
                    'Maintain a clean and tidy counter by emphasizing on use of set hygiene and cleaning standards.'
                ),
                'Integrity' => array(
                    'Ensures freshness of all products at all times through sampling.'
                ),
                'Margins' => array(
                    'Allocates baristas shifts and respective stations.'
                ),
                'L4L sales' => array(
                    'Ensures that all beverages and pastries are available and enough to meet and even exceed the guest’s demands for the day.'
                ),
            ),
            'Barista' => array(
                'NPS' => array(
                    'Ensures that recipes and S.O.Ps are followed to the latter for production of beverages and standards for portion sizes are consistently maintained.'
                ),
                'Food Safety' => array(
                    'Maintain accurate record of stocks at the barista counter and more so at the station allocated and advice the barista in charge when it falls below the per level for refill or reordering'
                ),
                'Integrity' => array(
                    'Ensures that all crockery and cutlery are appropriately arranged for visual display and use the chilled glasses are sparkling clean'
                ),
                'Margins' => array(
                    'Ensures that the S.O.Ps for counter cleanliness and hygiene are maintained and consistently adhered to.'
                ),
                'L4L sales' => array(
                    'Ensures that the pastry display, merchandise display, take away station and condiment organizers are clean, appropriately stocked and positioned.'
                ),
            ),
            'Branch Chef' => array(
                'NPS' => array(
                    'Ensure the highest level of hygiene in the kitchen by conducting regular food safety and hygiene audits.',
                    'Training of cooks and stewards in relation to set standards and policies.'
                ),
                'Food Safety' => array(
                    'Communicate to his/her supervisor on kitchen operations, guest feedback, food quality concerns and any operational challenges.',
                    'Ensure that quality food is produced using the correct recipe and on time.'
                ),
                'Integrity' => array(
                    'Train the new members in steward departments on correct usage of detergents.'
                ),
                'Margins' => array(
                    'Directs and supervises all the kitchen staff in the branch to ensure efficiency.',
                    'Ensures that all costs are within acceptable budget by enforcing use of SOPS, recipes and proper book keeping.'
                ),
                'L4L sales' => array(
                    'Ensure that all menu items are available for sale, while taking into account the freshness and order levels.',
                    'Ensuring guest satisfaction by guiding the kitchen team on quality and timely food production.'
                ),
            ),
            'Line Chef' => array(
                'NPS' => array(
                    'Training new cook on food production as per the set standards.'
                ),
                'Food Safety' => array(
                    'Proper handling of machines.'
                ),
                'Margins' => array(
                    'Supervises cooks and guides them on operations geared towards food quality.'
                ),
                'L4L sales' => array(
                    'Ensure the highest level of hygiene is achieved in line with food safety standards.',
                    'In charge of the kitchen in absence of the chef.',
                    'Ensure efficient food production to achieve the budgeted cost of sales.'
                ),
            ),
            'Buss person' => array(
                'NPS' => array(
                    'Ensure that the sops for restaurant hygiene are maintained and consistently adhered to in accordance to food safety requirements.'
                ),
                'Food Safety' => array(
                    'Cleaning, clearing and organizing table condiments.'
                ),
                'Integrity' => array(
                    'Attend to the tables and guarantee compliance to cleanliness standards'
                )
            ),
            'Area Manager' => array(
                'NPS' => array(
                    'Monitor  that guest’s satisfaction is met through consistently auditing the branch operations on a daily/regular basis'
                ),
                'Food Safety' => array(
                    'Enforce operational practices of all stores in the area, making sure each runs smoothly, cleanly, complies with food safety requirements.'
                ),
                'Integrity' => array(
                    'Monitor the training of staff and coordinates their progress to ensure the set procedures are adhered to.'
                ),
                'Margins' => array(
                    'Directly involved in analyzing the stores performance and ensure that the set budget is achieved on operational COS, sales and labor optimization.'
                ),
                'L4L sales' => array(
                    'Train and review financial statements and activity reports, other performance data to measure productivity of goal achievement to identify areas needing cost reduction or program improvement.'
                )
            ),
            'New Product Development Chef' => array(
                '100% completion of trials against the agreed schedule' => array(
                    'Completion of trials'
                ),
                '100% completion of all trial reports' => array(
                    'Trial report completion'
                ),
                'Successful completion and reporting of audits of at least 4 per month' => array(
                    'Process audits'
                ),
                'Conducts ingredient samples and completes reports within 24 hours with recommendations' => array(
                    'Sampling of new ingredients'
                ),
            ),
            'Regional Chef' => array(
                'NPS' => array(
                    'Ensuring all food safety guidelines are adhered to and achieve less non-conformance reports per month in regards quality and food safety related processes, and 100% root cause identification and resolution within 48 hours.'
                ),
                'Food Safety' => array(
                    'In charge of all kitchen and manufacturing staff training on new and current menu items in terms of quality and presentation.'
                ),
                'Integrity' => array(
                    'AEnsure that all food sold are of good quality in line with the establishment’s standards both at the branches and from the manufacturing unit.'
                ),
                'L4L sales' => array(
                    'Guides the chef, assistant chef and manufacturing team leaders on kitchen and staff management.'
                ),
                'Margins' => array(
                    'Ensure that all kitchens have all items in the menu to capture sales.'
                ),
                '100% delivery in full and on time of manufactured items to the national distribution center' => array(
                    'Helps the branch and assistant chef on all costs management and in relation to restaurant margins.',
                    'Coordinate with the Executive Chef and New Product Development Chef on new product and monthly specials.',
                    'In charge of staffing to ensure that labor is optimized and within the budget.',
                    'Ensuring guest satisfaction by guiding the kitchen and manufacturing team on quality and timely food production.',
                    'Ensure manufacturing unit cost controls are within agreed targets.'
                ),
            ),
            'Multi-Unit Chef (Ug/Rw)' => array(
                'NPS' => array(
                    'Ensuring all food safety guidelines are adhered to and achieve less non-conformance reports per month in regards quality and food safety related processes, and 100% root cause identification and resolution within 48 hours.'
                ),
                'Food Safety' => array(
                    'In charge of all kitchen and manufacturing staff training on new and current menu items in terms of quality and presentation.'
                ),
                'Integrity' => array(
                    'Ensure that all food sold are of good quality in line with the establishment’s standards both at the branches and from the manufacturing unit.'
                ),
                'L4L sales' => array(
                    'Guides the chef, assistant chef and manufacturing team leaders on kitchen and staff management.'
                ),
                'Margins' => array(
                    'Ensure that all kitchens have all items in the menu to capture sales.'
                ),
                '100% delivery in full and on time of manufactured items to the national distribution center' => array(
                    'Helps the branch and assistant chef on all costs management and in relation to restaurant margins.',
                    'Coordinate with the Executive Chef and New Product Development Chef on new product and monthly specials.',
                    'In charge of staffing to ensure that labor is optimized and within the budget.',
                    'Ensuring guest satisfaction by guiding the kitchen and manufacturing team on quality and timely food production.',
                    'Ensure manufacturing unit cost controls are within agreed targets.'
                ),
            ),
            'Multi-Unit Chef' => array(
                'NPS' => array(
                    'Ensuring all food safety guidelines are adhered to and achieve less non-conformance reports per month in regards quality and food safety related processes, and 100% root cause identification and resolution within 48 hours.'
                ),
                'Food Safety' => array(
                    'In charge of all kitchen and manufacturing staff training on new and current menu items in terms of quality and presentation.'
                ),
                'Integrity' => array(
                    'Ensure that all food sold are of good quality in line with the establishment’s standards both at the branches and from the manufacturing unit.'
                ),
                'L4L sales' => array(
                    'Guides the chef, assistant chef and manufacturing team leaders on kitchen and staff management.'
                ),
                'Margins' => array(
                    'Ensure that all kitchens have all items in the menu to capture sales.'
                ),
                '100% delivery in full and on time of manufactured items to the national distribution center' => array(
                    'Helps the branch and assistant chef on all costs management and in relation to restaurant margins.',
                    'Coordinate with the Executive Chef and New Product Development Chef on new product and monthly specials.',
                    'In charge of staffing to ensure that labor is optimized and within the budget.',
                    'Ensuring guest satisfaction by guiding the kitchen and manufacturing team on quality and timely food production.',
                    'Ensure manufacturing unit cost controls are within agreed targets.'
                ),
            ),
            'Guest Relations Officer' => array(
                'Give timelines on when assignments shall be completed' => array(
                    'Be on the forefront of Customer Service'
                ),
                'Increased amount of compliments won by the business.' => array(
                    'Attend promptly to customer inquiries and assist them with their needs.'
                ),
                'Minimized number of guest complaints' => array(
                    'Log in the day’s activities touching on guest feedback and action taken'
                ),
                'Increased repeat guests' => array(
                    'Brief and keep the Operations manager informed of everything that requires his/her extra attention in regards to guest feedback.'
                ),
                'Return of past aggrieved guest' => array(
                    'Provide information about facilities, programs, offers and other services offered by the company when requested by the customer.  '
                ),
                'Improved NPS' => array(),
            ),
            'Cost Management Accountant - Manufacturing' => array(
                'Alignment of system BOM and actual production' => array(
                    'Production planning and transaction processing'
                ),
                'Reduction in variances' => array(
                    'Variance analysis'
                ),
                'Effective communication of variance reports to management' => array(
                    'Stock management'
                ),
                'Good stock management' => array(
                    'Strong interpersonal relationships with manufacturing operation team',
                    'Talent and people management'
                ),
                'Successful implementation of the ERP' => array(
                    'Successful implementation of the ERP'
                ),
            ),
            'Production Accountant ' => array(
                'Reduction in stock loss variances' => array(
                    'Stock management processing and accounting'
                ),
                'Effective communication of variance reports to management' => array(
                    'Stock variance analysis'
                ),
                'Good stock management' => array(
                    'Management customer order fulfillment',
                    'Purchase price variance monitoring'
                ),
            ),
            'Quality Assurance Supervisor' => array(
                '100% implementation of quarterly internal audits) and follow up on CAP’s arising from the same.' => array(
                    'Effective resource management'
                ),
                '100% implementation of corrective actions resulting from audits and failed micro-analysis and ATP swab results.' => array(
                    'Audits'
                ),
                '100% compliance to food safety training schedules and induction training.' => array(
                    'Traceability'
                ),
                '100% traceability score within 2 hours during monthly traceability challenges' => array(
                    'Training'
                ),
                '100% follow up on filled FSR’s (Food safety reports) issued to suppliers for non-conformance arising to supplied products' => array(
                    'ATP & Micro testing of food , water & environmental swabs',
                    'Material specification for received items',
                    'Effective safety leadership',
                    'Effective communication'
                ),
            ),
            'Quality Assuarance Supervisor' => array(
                '100% implementation of quarterly internal audits) and follow up on CAP’s arising from the same.' => array(
                    'Effective resource management'
                ),
                '100% implementation of corrective actions resulting from audits and failed micro-analysis and ATP swab results.' => array(
                    'Audits'
                ),
                '100% compliance to food safety training schedules and induction training.' => array(
                    'Traceability'
                ),
                '100% traceability score within 2 hours during monthly traceability challenges' => array(
                    'Training'
                ),
                '100% follow up on filled FSR’s (Food safety reports) issued to suppliers for non-conformance arising to supplied products' => array(
                    'ATP & Micro testing of food , water & environmental swabs',
                    'Material specification for received items',
                    'Effective safety leadership',
                    'Effective communication'
                ),
            ),
            'Hygiene Officer' => array(
                '100% traceability score within 2 hours during monthly traceability challenges.' => array(
                    'Traceability'
                ),
                '100% implementation of quarterly internal audits and follow up on CAP’s arising from the same.' => array(
                    'Effective resource management'
                ),
                '100% implementation of corrective actions resulting from audits and failed micro-analysis and ATP swab results.' => array(
                    'Audits–Internal /supplier'
                ),
                '100% compliance to food safety training schedules and induction training.' => array(
                    'Training'
                ),
                '100% follow up on filled FSR’s (Food safety reports)issued to suppliers for non-conformance arising to supplied products and implementation of supplier audit schedule.' => array(
                    'ATP & Micro testing of food , water & environmental swabs',
                    'Material specification for received items',
                    'Effective safety leadership',
                    'Effective communication'
                ),
            ),
            'Quality Control Team Member' => array(
                '100% completion' => array(
                    'Completion of all documentation'
                ),
                '0% customer rejections due to missed product or process failures' => array(
                    'No operational impact as a result of poor shift planning'
                ),
                '0% quality related issues of B2B customers' => array(
                    'No out of spec product reaching the custom'
                ),
            ),
            'Customer Relations Manager' => array(
                'Resolution of customer queries within agreed TAT and SLA' => array(
                    'Delivering exceptional customer service'
                ),
                'Development and monitoring of key CRM metrics' => array(
                    'Developing and monitoring Key CRM metrics'
                ),
                'Daily, weekly and monthly reports' => array(
                    'Generation of CRM reports and analytics'
                ),
                'Sharing of best practice' => array(
                    'Modeling Service Excellence'
                ),
                '100% customer satisfaction' => array(
                    'Carry out customer satisfaction surveys'
                ),
            ),
            'Customer Relations Officer' => array(
                'Resolution of customer queries within agreed TAT and SLA' => array(
                    'Delivering exceptional customer service'
                ),
                'Daily, weekly and monthly reports' => array(
                    'Generation of CRM reports and analytics'
                ),
                '100% customer satisfaction' => array(
                    'Carry out customer satisfaction surveys'
                ),
                'No of hours taken' => array(
                    'Resolution time - average amount of time to resolve a case after it has been opened'
                )
            ),
            'Logistics & Warehousing Supervisor' => array(
                'On-time Delivery' => array(
                    'Effective Resource Management'
                ),
                'Crash Rates (Min 0 Max 0)' => array(
                    'Effective Routing & Delivery of Goods'
                ),
                '100% conformance to staff training needs analysis' => array(
                    'Effective Reporting'
                ),
                'Ensures 100% compliance in regards to safety inspections' => array(
                    'Effective Performance Measurement'
                ),
                '97% of planned shift compliance' => array(
                    'Effective communication',
                    'Effective Returns Management'
                )
            ),
            'Stores Supervisor' => array(
                'Perfect Order Rate & Out of Stock Situation' => array(
                    'Effective Resource Management'
                ),
                'Inventory Accuracy' => array(
                    'Effective Inventory Optimization'
                ),
                '100% conformance to staff training needs analysis' => array(
                    'Effective Reporting & Analysis'
                ),
                'Ensures 100% compliance in regards to warehouse safety inspections' => array(
                    'Effective Performance Measurement'
                ),
                '95% of planned shift compliance' => array(
                    'Effective Communication',
                    'Conformance to training needs analysis'
                ),
            ),
            'Verification Officer' => array(
                'Perfect Order Rate(POI)' => array(
                    'Effective Resource Management'
                ),
                'Order Fill Rate' => array(
                    'Strong Customer Focus'
                ),
                'Dispatch Accuracy' => array(
                    'Effective FoodSafety Leadership'
                ),
                '100% Conformance to Verification Quality Standards' => array(
                    'Effective Communication',
                    '100% Verification & Documentation Accuracy'
                ),
            ),
            'Receiving Officer ' => array(
                'Perfect Order Rate' => array(
                    'Effective Resource Management'
                ),
                'Order Fill Rate' => array(
                    'Strong customer focus'
                ),
                '100% Conformance to Quality Standards' => array(
                    'Effective Safety leadership',
                    'Effective communication',
                    'Conformance to training needs analysis'
                ),
            ),
            'Store keeper & Order Picker Driver' => array(
                'Inventory Accuracy' => array(
                    'Effective Contract Management & Administration'
                ),
                'Out of Stock Situation as a percentage' => array(
                    'Effective Reporting & Analysis'
                ),
                'Inventory Holding Cost to Budget' => array(
                    'Effective Safety leadership'
                ),
                'DIFOT Analysis (Min 98% Max 100%)' => array(
                    'Effective Communication'
                ),
                'Safety Observations & Safety of staff under warehouse.' => array(
                    '100 % conformance to training needs analysis',
                    'Effective Resource Management',
                    'Effective Inventory Optimization'
                ),
            ),
            'Maintenance Store keeper' => array(
                'Integrity' => array(
                    'Maintains the asset inventory of all equipment & fixtures',
                    'Monitors stocks, reorders and receives deliveries of spares, materials & tools',
                    'Allocates personnel to reactive maintenance requests',
                    'Coordinates night shift,planned preventive maintenance (PPM) & reactive maintenance activities',
                    'Digitises all maintenance work orders and PPM checklists',
                    'Receives and records daily  R&M activity reports'
                ),
            ),
            'Store keeper' => array(
                'Stock Out as a %' => array(
                    'Effective Resource Management'
                ),
                'Order Fill Rate' => array(
                    'Strong customer focus'
                ),
                'Inventory Accuracy' => array(
                    'Effective safety leadership'
                ),
                'FIFO / FEFO Shelf-life Modelling' => array(
                    'Effective communication',
                    'Conformance to training needs analysis'
                ),
            ),
            'Dispatch & Receiving Officer' => array(
                'Perfect Order Rate' => array(
                    'Effective Resource Management'
                ),
                'Order Fill Rate' => array(
                    'Strong customer focus'
                ),
                '100% Conformance to Quality Standards' => array(
                    'Effective Safety leadership',
                    'Effective communication',
                    'Conformance to training needs analysis'
                ),
            ),
            'Distribution Supervisor' => array(
                'DIFOT Analysis(Min 98% Max 100%)' => array(
                    'Effective Resource Management'
                ),
                'Customer Complaints (Min 1 Max 5)' => array(
                    'Effective Temperature Monitoring(Both Frozen, Chilled & Ambient)'
                ),
                'On-Time Performance(Min 98% Max 100%)' => array(
                    'Effective Reporting & Analysis'
                ),
                'Efficient Routing' => array(
                    'Effective Safety leadership'
                ),
                'Safety Observations & Safety of staff under distribution.' => array(
                    'Effective Communication',
                    '100 % conformance to training needs analysis'
                ),
            ),
            'Logistics Operator' => array(
                'On-time Delivery' => array(
                    'Effective to Delivery and Trips Management'
                ),
                'Zero Accident / Incident Rates' => array(
                    'Effective Reporting'
                ),
                '100% conformance to Traffic Act & Regulations' => array(
                    'Effective Communication'
                ),
            ),
            'Sales Supervisor' => array(
                'Acceptable reach rate will yield 32% more business in our pipeline.' => array(
                    'Reach rate'
                ),
                'Acceptable response time to any lead/follow up/inquiry should be at 95%.' => array(
                    'Lead response time'
                ),
                'Acceptable ratio should 5:1' => array(
                    'Opportunity to win ratio'
                ),
                'Minimum acceptable level - 70%' => array(
                    'Planning and reporting'
                ),
            ),
            'Sales Coordinator' => array(
                'Minimum acceptable level - 95%' => array(
                    'Planning, Coordinating and reporting'
                ),
                'Acceptable rate/follow up/inquiry should be at 95%.' => array(
                    'Sales Orders Projection Data'
                ),
                'Acceptable rate 99%' => array(
                    'Sales orders logging & execution'
                ),
            ),
            'Sales Representative' => array(
                'Acceptable reach rate will yield 32% more business in our pipeline.' => array(
                    'Reach rate'
                ),
                'Acceptable response time to any lead/follow up/inquiry should be at 95%.' => array(
                    'Lead response time'
                ),
                'Acceptable ratio should 5:1' => array(
                    'Opportunity to win ratio'
                ),
                'Minimum acceptable level - 70%' => array(
                    'Planning and reporting'
                ),
            ),
            'Sales Driver' => array(
                'Acceptable % rate is 90% +' => array(
                    'Full delivery on time'
                ),
                '360 feedback with internal and external customers' => array(
                    'Communicate courteously.'
                ),
                '100% attendance' => array(
                    'Attend weekly briefings when and where required.'
                ),
            ),
            'Merchandiser' => array(
                'Stocking of shelf should be 95% at all times with the agreed shelf space maintained at 100%.' => array(
                    'Ensures the allocated shelf space is always well stocked and space is maintained.'
                ),
                'All SKU’S should be at no time be out of stock.' => array(
                    'Ensures LPO’s are raised in good time to mitigate zero stock out before the replenishing delivery is done.'
                ),
                'Number/return of expired coffee should be at zero % at any given stores/account.' => array(
                    'Checking of short expires and advising on slow moving SKU’S.'
                ),
                'All promotions should be executed at a rate of 90 – 100% and the sales for the item under promotion should grow by not less than 15% LFL (Month/Year).' => array(
                    'Coordinates product sampling/promotions within the allocated stores'
                ),
            ),
            'Manufacturing Planner' => array(
                '95% conformance to the plan' => array(
                    'Conformance'
                ),
                '100% equipment availability' => array(
                    'Equipment'
                ),
                'Completion and reporting of audits on daily basis' => array(
                    'Process audits'
                ),
                '100% availability of staffing for production' => array(
                    'Labor'
                ),
                '100% onboarding of VUKA' => array(
                    'Successful implementation of the ERP'
                ),
            ),
            'Product Development Technologist' => array(
                '100% completion of trials against the agreed schedule' => array(
                    'Completion of trials'
                ),
                '100% completion of all trial reports' => array(
                    'Trial report completion'
                ),
                'Successful completion and reporting of audits of at least 4 per month' => array(
                    'Process audits'
                ),
                'Conducts ingredient samples and completes reports within 24 hours with recommendations' => array(
                    'Sampling of new ingredients'
                ),
            ),
            'Shift Supervisor - Manufacturing' => array(
                '100% attainment of leading safety inTeam Leader - Manufacturing  (Head Baker)dicators (safety observations, audits and tool box talks)' => array(
                    'Safety'
                ),
                '100% compliance to PPM schedule as set in the production plan, and as agreed between manufacturing and maintenance managers' => array(
                    'Equipment availability'
                ),
                '100% compliance to the PD schedules as set by in the production plan and as agreed between the manufacturing and PD managers' => array(
                    'Product development'
                ),
                '+/-0.25% variance against standard in regards materials and staffing' => array(
                    'Financial performance'
                ),
                'To achieve less than 5 non conformance reports per month in regards quality and food safety related processes, and 100% root cause identification and resolution within 48 hours' => array(
                    'Quality & food safety'
                ),
                'Responsible for ensuring data capture for inventory processing on shift, 100% reconciliation when audited or during a recall exercise' => array(
                    'Inventory controls'
                ),
            ),
            'Team Leader - Manufacturing  (Head Baker)' => array(
                'Variance of +/- 5% of process rates when measured against standard' => array(
                    'Effective resource management'
                ),
                'Minimum of 97% DIFOT' => array(
                    'Strong customer focus'
                ),
                '100% completion of daily safety inspections' => array(
                    'Effective safety leadership'
                ),
                '100% completion of tool box talks against the department comms schedule' => array(
                    'Effective communication'
                ),
                '100% conformance to the staff training needs analysis' => array(
                    'Conformance to training needs analysis'
                ),
            ),
            'Team Leader - Manufacturing (Oven Man)' => array(
                'Variance of +/- 5% of process rates when measured against standard' => array(
                    'Effective resource management'
                ),
                'Minimum of 97% DIFOT' => array(
                    'Strong customer focus'
                ),
                '100% completion of daily safety inspections' => array(
                    'Effective safety leadership'
                ),
                '100% completion of tool box talks against the department comms schedule' => array(
                    'Effective communication'
                ),
                '100% conformance to the staff training needs analysis' => array(
                    'Conformance to training needs analysis'
                )
            ),
            'Team Member - Manufacturing (Baker I)' => array(
                'Variance of +0.5/-0.of process rates when measured against standard' => array(
                    'SOP/ Work Instruction follow up'
                ),
                'Training attendance in a year' => array(
                    'Undertake training to meet food legislation requirements.'
                ),
                'Safety reporting document' => array(
                    'Reporting of safety incidences',
                    'Attending the tool box talk'
                ),
            ),
            'Team Member - Manufacturing (Junior Baker)' => array(
                'Variance of +0.5/-0.of process rates when measured against standard' => array(
                    'SOP/ Work Instruction follow up'
                ),
                'Training attendance in a year' => array(
                    'Undertake training to meet food legislation requirements.'
                ),
                'Safety reporting document' => array(
                    'Reporting of safety incidences',
                    'Attending the tool box talk'
                ),
            ),
            'Team Member - Manufacturing (Bakery Handy Helper)' => array(
                'Variance of +0.5/-0.of process rates when measured against standard' => array(
                    'SOP/ Work Instruction follow up'
                ),
                'Training attendance in a year' => array(
                    'Undertake training to meet food legislation requirements.'
                ),
                'Safety reporting document' => array(
                    'Reporting of safety incidences',
                    'Attending the tool box talk'
                ),
            ),
            'Team Leader - Manufacturing (Assistant Supervisor, Ice Cream)' => array(
                'Variance of +/- 5% of process rates when measured against standard' => array(
                    'Effective resource management'
                ),
                'Minimum of 97% DIFOT' => array(
                    'Strong customer focus'
                ),
                '100% completion of daily safety inspections' => array(
                    'Effective safety leadership'
                ),
                '100% completion of tool box talks against the department comms schedule' => array(
                    'Effective communication'
                ),
                '100% conformance to the staff training needs analysis' => array(
                    'Conformance to training needs analysis'
                ),
            ),
            'Team Member - Manufacturing (Junior Ice Cream Assistant)' => array(
                'Variance of +0.5/-0.of process rates when measured against standard' => array(
                    'SOP/ Work Instruction follow up'
                ),
                'Training attendance in a year' => array(
                    'Undertake training to meet food legislation requirements.'
                ),
                'Safety reporting document' => array(
                    'Reporting of safety incidences',
                    'Attending the tool box talk'
                ),
            ),
            'Shift Supervisor - Manufacturing (Assistant Supervisor)' => array(
                '100% attainment of leading safety indicators (safety observations, audits and tool box talks)' => array(
                    'Safety'
                ),
                '100% compliance to PPM schedule as set in the production plan, and as agreed between manufacturing and maintenance managers' => array(
                    'Equipment availability'
                ),
                '100% compliance to the PD schedules as set by in the production plan and as agreed between the manufacturing and PD managers' => array(
                    'Product development'
                ),
                '+/-0.25% variance against standard in regards materials and staffing' => array(
                    'Financial performance'
                ),
                'To achieve less than 5 non conformance reports per month in regards quality and food safety related processes, and 100% root cause identification and resolution within 48 hours' => array(
                    'Quality & food safety'
                ),
                'Responsible for ensuring data capture for inventory processing on shift, 100% reconciliation when audited or during a recall exercise' => array(
                    'Inventory controls'
                ),
            ),
            'Team Leader - Manufacturing (Roaster)' => array(
                'Variance of +/- 5% of process rates when measured against standard' => array(
                    'Effective resource management'
                ),
                'Minimum of 97% DIFOT' => array(
                    'Strong customer focus'
                ),
                '100% completion of daily safety inspections' => array(
                    'Effective safety leadership'
                ),
                '100% completion of tool box talks against the department comms schedule' => array(
                    'Effective communication'
                ),
                '100% conformance to the staff training needs analysis' => array(
                    'Conformance to training needs analysis'
                ),
            ),
            'Team Member - Manufacturing (Packer III)' => array(
                'Variance of +0.5/-0.of process rates when measured against standard' => array(
                    'SOP/ Work Instruction follow up'
                ),
                'Training attendance in a year' => array(
                    'Undertake training to meet food legislation requirements.'
                ),
                'Safety reporting document' => array(
                    'Reporting of safety incidences',
                    'Attending the tool box talk'
                ),
            ),
            'Manufacturing Supervisor (Commissary Chef)' => array(
                '100% attainment of leading safety indicators (safety observations, audits and tool box talks)' => array(
                    'Safety'
                ),
                '100% compliance to PPM schedule as set in the production plan, and as agreed between manufacturing and maintenance managers' => array(
                    'Equipment availability'
                ),
                '100% compliance to the PD schedules as set by in the production plan and as agreed between the manufacturing and PD managers' => array(
                    'Product development'
                ),
                '+/-0.25% variance against standard in regards materials and staffing' => array(
                    'Financial performance'
                ),
                'To achieve less than 5 non conformance reports per month in regards quality and food safety related processes, and 100% root cause identification and resolution within 48 hours' => array(
                    'Quality & food safety'
                ),
                'Responsible for ensuring data capture for inventory processing on shift, 100% reconciliation when audited or during a recall exercise' => array(
                    'Inventory controls'
                )
            ),
            'Team Leader - Manufacturing (Assistant Commissary Chef)' => array(
                'Variance of +/- 5% of process rates when measured against standard' => array(
                    'Effective resource management'
                ),
                'Minimum of 97% DIFOT' => array(
                    'Strong customer focus'
                ),
                '100% completion of daily safety inspections' => array(
                    'Effective safety leadership'
                ),
                '100% completion of tool box talks against the department comms schedule' => array(
                    'Effective communication'
                ),
                '100% conformance to the staff training needs analysis' => array(
                    'Conformance to training needs analysis'
                ),
            ),
            'Team Member - Manufacturing (Cook II)' => array(
                'Variance of +0.5/-0.of process rates when measured against standard' => array(
                    'SOP/ Work Instruction follow up'
                ),
                'Training attendance in a year' => array(
                    'Undertake training to meet food legislation requirements.'
                ),
                'Safety reporting document' => array(
                    'Reporting of safety incidences',
                    'Attending the tool box talk'
                ),
            ),
            'Team Leader - Manufacturing (Cafeteria Cook in Charge)' => array(
                'Variance of +/- 5% of process rates when measured against standard' => array(
                    'Effective resource management'
                ),
                'Minimum of 97% DIFOT' => array(
                    'Strong customer focus'
                ),
                '100% completion of daily safety inspections' => array(
                    'Effective safety leadership'
                ),
                '100% completion of tool box talks against the department comms schedule' => array(
                    'Effective communication'
                ),
                '100% conformance to the staff training needs analysis' => array(
                    'Conformance to training needs analysis'
                ),
            ),
            'Hygiene Manager' => array(
                'Meets the budgeted expenditure for department expenditure on a monthly basis' => array(
                    'Effective resource management'
                ),
                'Generates and presents a weekly report that includes swab results, chemical consumption and staffing costs' => array(
                    'Effective reporting'
                ),
                'Ensures that 100% of the commissary staff have been trained on chemical awareness within one week of joining' => array(
                    'Effective safety leadership'
                ),
                'Maintains the department information board updated on a weekly basis that includes department performance and educates all employees of 5S practices and good housekeeping standards' => array(
                    'Effective communication'
                ),
                '100% conformance to the staff training needs analysis' => array(
                    'Conformance to training needs analysis'
                ),
            ),
            'Team Member - Hygiene (Commissary Steward)' => array(
                'Meeting the required consumption values per cleaning application' => array(
                    'Chemical consumption'
                ),
                'Zero accidents' => array(
                    'Safety'
                ),
                '100% attendance to all relevant town halls or tool box talks' => array(
                    'Communication'
                ),
            ),
            'Loader' => array(
                'Measures' => array(
                    'Accurate recording and reporting',
                    'To achieve satisfactory scores in all customer quality assessment measures.',
                    'Adherence to Occupational Safety and Health Procedures'
                )
            ),
            'Team Leader -Produce (Head of Food Production)' => array(
                'Incident and accident rates for specific department' => array(
                    'Adherence to work schedules and performance criteria.'
                ),
                'Achieve all PDP objectives as agreed with Shift Manager.' => array(
                    'Perform all work in line with trained SOPs and adherence to OSH procedures'
                ),
                'Number of suggestions or ideas shared.' => array(
                    'Attend all production briefings'
                ),
                '100% delivery in full and on time of manufactured items to the production target.' => array(
                    'Support team development through knowledge sharing and giving suggestions on how to improve processes.'
                ),
                'Customer quality complaints not exceeding agreed targets.' => array(
                    'Achieve production target'
                ),
                'The number of processes completed right first time, without the need for corrective action or rejection' => array(
                    'To achieve satisfactory scores in all customer quality assessment measures.',
                    'Ensures quality of all outputs'
                ),
            ),
            'Team Member - Produce (Food Production Steward)' => array(
                'The number of processes completed right first time, without the need for corrective action or rejection' => array(
                    'Adherence to work schedules and performance criteria'
                ),
                'Incident and accident rates for specific department' => array(
                    'Perform all work in line with trained SOPs and adherence to OSH procedures'
                ),
                'Achieve all PDP objectives as agreed with Team Leader' => array(
                    'Delivery to customers in full and on time'
                ),
                'Number of suggestions or ideas shared.' => array(
                    'To achieve satisfactory scores in all customer quality assessment measures'
                ),
                '100% delivery in full and on time of manufactured items' => array(),
                'Customer quality complaints not exceeding agreed targets' => array(),
            ),
            'Laundry assistant' => array(
                'Variance of +0.5/-0.of process rates when measured against standard' => array(
                    'SOP/ Work Instruction follow up'
                ),
                'Training attendance in a year' => array(
                    'Attend laundry schedule training'
                ),
                'Safety reporting document' => array(
                    'Reporting of safety incidence'
                ),
            ),
            'Procurement Manager' => array(
                'On budget performance' => array(
                    'Cost Saving initiatives: Initiates structured approaches to continually review and challenging the existing pricing structures with an aim of measuring and reducing the costs'
                ),
                'Out of Stock Situation as a percentage' => array(
                    'Budget Control: Participates in the Budgeting process and controlling operating costs within the approved budgets '
                ),
                'Supplier defect rate' => array(
                    'Product Availability: Product availability is crucial for customer service level and this performance indicator will be monitored through out of stock situations. '
                ),
                'Order processing cycle' => array(
                    'Procurement process cycle (Speed): The speed from the order to delivery cycle is critical in the service level delivery and the procurement manager must measure and continually improvement ',
                    'Supplier performance measurement: Measuring the performance of key suppliers is not only important but critical in achieving the business goals of cost, quality, speed, delivery and flexibility. '
                ),
            ),
            'Procurement Officer' => array(
                'Out Of Stock situation as a percentage' => array(
                    'Product Availability- To secure the sourcing of the right products in a right time, in a right place, in a right quality and quantity, with the right total costs.-This will be measured using Out Of Stock Situation'
                ),
                'Order processing cycle' => array(
                    'Lead Time- interval of time between the initiation of a procurement action, and the receipt of the production model into the supply system'
                ),
                'On Budget Performance' => array(
                    'Cost saving Initiatives Initiates structured approaches to continually review and challenging the existing pricing structures with an aim of measuring and reducing the costs'
                ),
            ),
            'Service Desk Officer' => array(
                'Number of hours taken' => array(
                    'Resolution time i.e. average amount of time to resolve a case after it has been opened'
                ),
                '0% backlog in filing and record keeping tasks' => array(
                    'Email and Filling backlog'
                ),
                'Good customer feedback' => array(
                    'Customer Satisfaction'
                ),
            ),
            'Finance Manager' => array(
                'Accountability' => array(
                    'Ensure that the company reporting is as per the International Accounting standards (IASs).',
                    'Ensure that all the controls are in place to monitor and safe guard all company assets.'
                ),
                'Integrity' => array(
                    'Preparation and communication of management accounting information.',
                    'Payroll management, look at error rates.'
                ),
                'Systems control' => array(
                    'Timely approvals of suppliers’ payments.',
                    'General Ledger management.'
                ),
                'Accurate & timely P&L reports.' => array(
                    'Commissary Store management supervision.',
                    'Overall management of accounts team and ensure monthly reporting is on time'
                ),
                'Tax & other statutory Regulations compliance.' => array(
                    'Overall management of the monthly statutory tax return including of approvals of actual taxes to be remitted revenue authorities.',
                    'Annual audits are fully supported and any relevant documentation availed.',
                    'Accurate & timely monthly profit & loss reports'
                ),
            ),
            'Senior Branch Accountant' => array(
                'Increased branch efficiency and favorable cost.' => array(
                    'Performs all relevant duties/responsibilities with little or no supervision with the ability to monitor all activities '
                ),
                'Improved performance across all the branch operations.' => array(
                    'Supervision of overall branch operations that affect the performance and bring suggestions that improve efficiency.'
                ),
                'Safe custody of branch monies.' => array(
                    'Flexibility to run more than one branch in different areas effectively.'
                ),
            ),
            'Roaster And Coffee Sales Representative' => array(
                'Acceptable reach rate will yield 32% more business in our pipeline.' => array(
                    'Reach rate'
                ),
                'Acceptable response time to any lead/follow up/inquiry should be at 95%.' => array(
                    'Lead response time'
                ),
                'Acceptable ratio should 5:1' => array(
                    'Opportunity to win ratio'
                ),
                'Minimum acceptable level - 70%' => array(
                    'Planning and reporting'
                ),
            ),
            'Head of EPOS' => array(
                '100% EPOS health expected' => array(
                    'Ensure the EPOS servers and databases are up to date and compliant with the set standards.'
                ),
                '100% consistency expected across all databases and branches.' => array(
                    'Ensure there is EPOS consistency across all the branches.'
                ),
                '99% support for users on application programs expected.' => array(
                    'Ensure users are fully supported on the existing MICROS and related application programs.'
                ),
                '100% configuration and maintenance of all EPOS related systems while best industry standards.' => array(
                    'Configuration, Monitoring, Administration of Branch MICROS Application programs.'
                ),
                '100% data integrity, availability and security expected always' => array(
                    'Maintain best industry standards for EPOS systems, Upgrades, promotions, Menu updates, discounts and offers.',
                    'Maintain Data integrity and availability'
                ),
            ),
            'Head of Infrastructure' => array(
                'Higher Systems & Network availability uptime.' => array(
                    'Ensuring servers, Databases, POS Hardware & Network availability uptime of 95.5 % '
                ),
                'Ensure minimum incidents escalations.' => array(
                    'Ensuring the data is kept secure and backups have been taken and tested regularly (Quarterly)'
                ),
                'Ensure that User calls & Incidents are Logged into Helpdesk system & addressed within agreed on SLA.' => array(
                    'Ensure resolution of Incidents/request without escalations. '
                ),
                'Compliance with backup & restoration requirements.' => array(
                    'Ensure that 90% of all User calls & Incidents are Logged into Helpdesk system & addressed within agreed SLA'
                )
            ),
            'ERP Analyst' => array(
                'Ensure all User calls & Incidents are Logged into Helpdesk system.' => array(
                    'Ensure that all ERP/Core applications Incidents Are Logged into Helpdesk system & addressed within agreed SLA.'
                ),
                'Maximize utilization of ERP modules & reports.' => array(
                    'Ensure that users are well versed with reports in their respective modules.'
                ),
                'Ensure resolution of all ERP issues reported by business users are addressed (both internal support & external support)' => array(
                    'Ensure that critical updates/ objects are deployed in a timely manner.'
                ),
            ),
            'Networks & Security Engineer' => array(
                '98% Network reliability expected' => array(
                    'Ensure network reliability across all Java /Py and     360 degrees core network.'
                ),
                '98% uptime expected for all the guest Wi-Fi connections' => array(
                    'Ensure uptime for all the guest WiFi connections for all outlets.'
                ),
                '100% Cyber security compliance expected.' => array(
                    'Ensure Cyber security compliance in our core network is achieved all the time.'
                ),
                '100% configuration of routers, switches, and all other related Network equipment to be achieved before opening of a new branch and 100% support rendered thereafter.' => array(
                    'Supporting, Configuration, Monitoring, Administration of WAN, LANs, Switches, Routers, internet Routers/WAN optimizers & Internet providers',
                    'Evaluate access controls and roles of system users with respect to network and systems security'
                )
            ),
            'Systems Administrator' => array(
                '100% antivirus protection on all PCs, Laptops and Servers expected.' => array(
                    'Ensure the application and database servers have up to date and compliant operating system.'
                ),
                '100% configuration and maintenance of computer related systems and hardware are working to the best industry standards.' => array(
                    'Ensure users are fully supported on the existing application programs.'
                ),
                '100% data integrity, availability and security expected always' => array(
                    'Configuration, Monitoring, Administration of Branch Application programs.',
                    'Maintain best industry standards for ICT systems and programs. General cleanliness of computer related hardware'
                )
            ),
            'Hardware Support Technician' => array(
                'Reduced Downtime rate' => array(
                    'Ensuring high availability uptime of Printers, Cabling, Music system & CCTV system '
                ),
                'Customer Satisfaction' => array(
                    'Efficient resolution of user incidents and IT requests.'
                ),
                '100% job completion rate' => array(
                    'Effective Co-ordination of IT support across all branches'
                )
            ),
            'IT Support Executive' => array(
                'Reduced Downtime rate' => array(
                    'Ensure high availability and uptime of IT hardware, software, point-of-sale system, network and related ICT technologies.'
                ),
                'Customer Satisfaction' => array(
                    'Efficient and effective resolution of end user incidents and IT requests.'
                ),
                'Ensure minimum incidents escalations.' => array(
                    'Effective IT monitoring, response, reporting and escalation of issues'
                )
            ),
            'Brand Marketer' => array(
                'Increase revenue by at least 2-3% P/A at individual store level.' => array(
                    'Monitor daily, weekly & monthly sales vs budget for each branch'
                ),
                'Ensure brand ownership at internal level and contribute to staff motivation' => array(
                    'Conduct brand audits and engage in activities to support consistent, efficient delivery of brand promise'
                ),
                'Local community brand ownership with increase in loyalty and frequency of buying of at least 10% p/a per store ' => array(
                    'Development and continuous updating of a local community map for each restaurant and regional mapping with greater team'
                ),
                'Keep customer experience audit performance above minimal pass rate.' => array(
                    'Planning local store and regional marketing initiatives to drive revenue and brand presence for each branch'
                ),
            ),
            'Digital Marketer' => array(
                'Increase website traffic 30% by the end of the financial year.' => array(
                    'Management of Java’s online marketing strategy to drive reach, authority and return on investment '
                ),
                'Increase organic traffic of Java house website by 15% through website optimization by the end of the year.' => array(
                    'Planning and executing digital marketing campaigns and designs'
                ),
                'Increase customer awareness of Java house by 15% through social media content by the end of the year.' => array(
                    'Maintain and supply content for Java’s websites and online platforms'
                ),
                'Increase the number of customer loyalty sign up by 10% by the end of 6 months.' => array(
                    'Ensuring all digital engagements standard operating procedures meet regulatory requirements to minimize brand reputation risk'
                ),
                'Increase customer engagement of Java house customers by 20% by the end of the year through customer loyalty.' => array(
                    'Creation and management of all key related relationships and service providers. '
                ),
                'Email marketing opening rate at least 15%.' => array(
                    'Reporting and analytics on Ad Hoc, weekly and monthly  '
                )
            ),
            'Marketing Coordinator' => array(
                'Grow L4L sales by 3%' => array(
                    'Monitor daily, weekly & monthly sales vs budget for each branch'
                ),
                'Analysis and measurement of brand and LSM interventions on a monthly basis; achieve ROMI above 15%.' => array(
                    'Track market trends & develop insights'
                ),
                ' Ensure seamless campaign execution of the three pillars to achieve an annual revenue of 25% of total sales' => array(
                    'Planning local store and regional marketing initiatives to drive revenue and brand presence for each branch'
                ),
                'Keep customer experience audit performance above minimal pass rate' => array(
                    'Supervise brand audits and engage in activities to support consistent, efficient delivery of brand promise',
                    'Liaison with Multi-unit managers and restaurant managers on marketing activities',
                    'Seamless execution calendar events across the region',
                    'Monthly reporting on brand performance and recommending relevant strategies based on the numbers'
                )
            ),
            'Senior Regional Accountant' => array(
                'Statutory compliant in the region' => array(
                    'Local tax laws and accounting standards understating'
                ),
                'Elimination of financial risk' => array(
                    'SOP Financial transactions implementation and monitoring (Stock, Assets, Petty Cash, Banks)'
                ),
                'Strong team building ' => array(
                    'Talent and people management'
                ),
                'Financial reporting is done by agreed deadlines' => array(
                    'Timely financial reporting'
                )
            ),
            'Management Accountant' => array(
                'Meeting reporting deadlines' => array(
                    'Assist on the accurate and timely management preparation of accounts for all the divisions'
                ),
                'Manage data processing and analysis' => array(
                    'Review system process flow for improved reporting'
                ),
                'Provide insightful business information' => array(
                    'Manage export and import transactions are processed accurately to eliminate risk'
                ),
                'Improved efficiency in system flow' => array(
                    'Manage data integration'
                ),
                '100% completion of ERP processes' => array(
                    'Successful implementation of the ERP'
                ),
            ),
            'Senior Treasury Accountant' => array(
                'Accurate processing of the bank reconciliations' => array(
                    'Operational cash flow management'
                ),
                'Optimal management of operational cash flow' => array(
                    'Management of bank reconciliations'
                ),
                'Management the integrity of supplier bank information' => array(
                    'Organization petty cash management '
                ),
                ' Petty cash management' => array(
                    'Rationalizing of the organizations banks'
                ),
                'Improved system efficiency on cash inflows and outflows' => array(
                    'Management of the integrity of online supplier’s bank information'
                ),
                '100% completion of ERP processes' => array(
                    'Successful implementation of the ERP treasury function'
                )
            ),
            'Senior Payables Accountant' => array(
                'Meeting reporting deadlines' => array(
                    'Maintaining of the supplier ledger to the payment terms'
                ),
                'Maintenance of supplier’s information' => array(
                    'Vetting and management of the supplier’s information in the system'
                ),
                'Talent and people management of the account payable team' => array(
                    'Management of the account payable team'
                ),
                'Maintaining of a clean aged payable ledger' => array(
                    'Preparation of accurate and timely account payable reports '
                ),
                'Improved system efficiency of the account payable function' => array(
                    'Resolving of supplier queries '
                ),
                '100% completion of ERP processes' => array(
                    'Successful implementation of the ERP'
                )
            ),
            'Group Cost Controller' => array(
                'Meeting  all statutory payment deadlines' => array(
                    'Accurate reconciliation of all the statutory requirements'
                ),
                'Improved efficiency in statutory  processing and payment' => array(
                    'Timely payments of all Statutory payment'
                ),
                'Zero private data leaks' => array(
                    'Safeguarding data security '
                ),
                'Successful implementation of the ERP' => array(
                    'Review system process flow for improved reporting'
                ),
            ),
            'Debtors Controller' => array(
                'KRA\'s' => array(
                    ' Manage customer accounts ',
                    ' Debt collection',
                    ' Manage cash collections days',
                    ' Manage receivable ledger ',
                    ' Meeting reporting deadlines'
                )
            ),
            'General Accountant' => array(
                'Updated & clean ageing creditor reports' => array(
                    ' Supplier reconciliations'
                ),
                'Accurate, timely and reliable financial reports' => array(
                    ' Bank Reconciliation'
                ),
                'Tax compliance' => array(
                    ' Complete and accurate data processing'
                ),
                'Updated and clean Bank Reconciliation' => array(
                    ' Tax Compliance'
                ),
                'Traceable complete filing system' => array(
                    ' Maintaining of financial records/documents '
                ),
            ),
            'Manufacturing Accountant' => array(
                'Reduction in stock loss variances' => array(
                    'Stock management processing and accounting'
                ),
                'Effective communication of variance reports to management' => array(
                    'Stock variance analysis'
                ),
                'Good stock management, ICS ' => array(
                    'Management customer order fulfillment ',
                    'Purchase price variance monitoring ',
                    'Manufacturing variances '
                )
            ),
            'Training Coordinator' => array(
                'Successful creation and implementation of learning and development' => array(
                    'Ensures the provision of effective learning and development solutions across the company.'
                ),
                'Development of training need analysis across board' => array(
                    'Provides coaching and advice to managers and staff on identifying and resolving learning and development needs'
                ),
                'Successful implementation of trainings in the whole group' => array(
                    'Manages the execution of L&D activities across the group'
                ),
                'Having the right staff with the correct skill in the right roles leading to high performance.' => array(
                    'Management of the competency matrix'
                ),
            ),
            'Training Co-ordinator' => array(
                'Successful creation and implementation of learning and development' => array(
                    'Ensures the provision of effective learning and development solutions across the company.'
                ),
                'Development of training need analysis across board' => array(
                    'Provides coaching and advice to managers and staff on identifying and resolving learning and development needs'
                ),
                'Successful implementation of trainings in the whole group' => array(
                    'Manages the execution of L&D activities across the group'
                ),
                'Having the right staff with the correct skill in the right roles leading to high performance.' => array(
                    'Management of the competency matrix'
                ),
            ),
            'Human Resource Assistant' => array(
                'Quality of work done.' => array(
                    'Administrative: Managing personnel files and staying focused on department projects till completion.'
                ),
                'Staff retention.' => array(
                    'Recruitment: Assist to find qualified workers and adjust them to the organizations culture. '
                ),
                'Timely submission of payroll related documents.' => array(
                    'Compensation: Assist in processing payroll efficiently and accurately.'
                ),
                'Minimal staff complaints.' => array(
                    'Employee Relations: Assist to promote the teamwork spirit among employees and motivation among employees.'
                ),
                'Well informed staff after orientation.' => array(
                    'Employee Orientation: Helping new hires adjust to the company by organizing for orientation seminars. '
                ),
                'Minimal Non-Compliance with the law' => array(
                    'Ensure compliance to HR policies, statutory laws and good practice'
                ),
                'Sound HR decisions made by Management' => array(
                    'Provide sound advice to management and staff on HR issues'
                ),
            ),
            'HR Officer II' => array(
                'Customer Satisfaction :Increase Internal customer satisfaction' => array(
                    'Administrative support and Employee Assistance in maintaining pension, employee files, Staff IDs, Strategies how to stop absenteeism in its tracks, Communications on behalf of welfare, GPA / WIBA compensations'
                ),
                'HR Processes:Decrease number of administrative errors per week' => array(
                    'Ensure day-to-day management of the HRMIS,'
                ),
                'Increase Analytical competencies in HR  ' => array(
                    'Provision of regular reports to HRM and support overall staff administration by Heads of Department, specifically leave utilization and liability reports, compliance reports etc. '
                ),
                'Return on investment in Trainings,CSR & Teambuilding' => array(
                    'Coordination of Employee motivation programmes e.g.  Internal Games, team building'
                ),
                '100 % issues raised in Health and safety actioned & 100% corrective actions closed out within the specified time –frame ' => array(
                    'Liaise with staff in assigned branches to provide necessary HR guidance as required'
                ),
                'Percentage of attendance at occupational health and safety (OHS) committee meetings' => array(
                    'Ensure Safety and Health issues are acted on promptly and trainings are conducted as per annual calendar'
                ),
            ),
            'HR Executive Admin' => array(
                ' Accurate and good quality of work done.' => array(
                    ' Preparing and Issuing out warning letters, Confirmation& Promotion '
                ),
                ' Timely payments of invoices, and reduction of medical complaints.' => array(
                    ' Managing the medical scheme'
                ),
                ' Neatness of staff uniforms.' => array(
                    ' Issuance of staff uniform '
                ),
                ' Timely reporting of GPA cases and timely payments of invoices' => array(
                    ' Managing GPA/WIBA scheme'
                ),
                ' Well informed staff' => array(
                    ' Addressing the induction or orientation process within a monthly basis for ensuring new staff have submitted the statutory details.'
                ),
                ' Minimal Non-Compliance with the law' => array(
                    ' Ensure compliance to HR policies, statutory laws and good practice'
                ),
                ' The Executive Leadership Team are able to handle crucial tasks without missing crucial appointments and meetings' => array(
                    'Organization & Judgment: One is required to manage the time of the Executive Leadership Team  in an efficient way'
                ),
                ' The Executive Leadership Team will be able to get assisted on any issue due to the extensive network of contacts attained' => array(
                    ' Resourcefulness'
                ),
            ),
            'Human Resources Supervisor' => array(
                'Timely provision of HR reports' => array(
                    'HR reports'
                ),
                ' Number of initiatives and suggestions highlighted that lead to financial savings for the business ' => array(
                    'Financial focus'
                ),
                'Developing direct reports through job shadowing, coaching and mentoring initiatives. Attainment of development goals set in their PDP' => array(
                    'People Development'
                ),
                'Ensuring that all processes adhere to company policies, national and international laws' => array(
                    'Compliance'
                ),
                'Timely delivery of HR service requests and resolution of HR issues within the agreed Turn Around Time (TAT)s and SLAs' => array(
                    'Customer focus'
                ),
            ),
            'Internal Audit Assistant' => array(
                ' At least 90% of audit assignments started and completed within set timelines.' => array(
                    ' Carries out audit assignments according to set and agreed standards'
                ),
                ' Completion of all assigned branch assessments.' => array(
                    ' Exercise probity'
                ),
                'High level of application of internal auditing standards & methodology including timely clearance of review queries.' => array(
                    ' Liaison with key staff to get information for audits and responses to queries',
                    ' Completion of support functions audit assignments within agreed timelines.',
                    ' Completion of branch reviews within the agreed timelines.',
                    ' Demonstrate continuous learning and improvement of skill in internal auditing.'
                ),
            ),
            'Internal Auditor' => array(
                ' At least 90% of audit assignments started and completed within set timelines.' => array(
                    ' Carries out audit assignments according to set and agreed standards',
                ),
                ' Completion of all assigned branch assessments.' => array(
                    ' Exercise probity'
                ),
                'High level of application of internal auditing standards & methodology including timely clearance of review queries.' => array(
                    ' Liaison with key staff to get information for audits and responses to queries',
                    ' Completion of support functions audit assignments within agreed timelines.',
                    ' Completion of branch reviews within the agreed timelines.',
                    ' Demonstrate continuous learning and improvement of skill in internal auditing.'
                ),
            ),
            'Audit Supervisor' => array(
                '>=90% of branches within the set target of review within 4 months.' => array(
                    'Coordination of branch reviews by sending out a schedule of branches that are due for review and allocation of the same based on team workload. At the end of the month update the master schedule with scores and summarize key issues from the month’s reviews.'
                ),
                'Timely reports on branch reviews-By 3rd working day of following month.' => array(
                    'Training/supervision of the Internal Audit Assistant'
                ),
                'Ensuring the Internal Audit Assistant is productively engaged-Assigned tasks are completed on time and to set standards' => array(
                    'Exercise probity'
                ),
                '>=90% of assigned audit assignments started and completed within set timelines.' => array(
                    'Build relationships with key staff and management'
                ),
                'High level of application of internal auditing standards & methodology to senior officer level.' => array(
                    'Timely completion of assigned audit assignments '
                ),
                'Closure of issues/recommendations raised – target >85%' => array(
                    'Completion of audit assignments according to set standards and guidelines'
                ),
            ),
            'Risk Manager' => array(
                ' Quarterly review of the risk registers to ensure all risks and mitigating actions are well captured ' => array(
                    'Updated risk register'
                ),
                ' 80% coverage of the compliance assessments plan,Raise exceptions from the assessments and ensure timely closure of the gaps' => array(
                    'Compliance assessments'
                ),
                ' Implemented mitigation activities through reduced high-risk audit gaps identified,  Implementation of and training on SOPs' => array(
                    'Development of mitigation plans'
                ),
                ' Consistent risk champions sessions, Implemented fraud risk management framework, Implemented incident reporting framework' => array(
                    'Ensuring Java’s ERM policy is well implemented'
                ),
                ' Improved control environment,  Process and controls standardization across the business' => array(
                    'Helping develop processes and SOPs to better mitigate risks'
                ),
                'Quarterly summary for reporting - Continuous communication with stakeholders to ensure relevant stakeholders are risk aware ' => array(
                    'Reporting and communication'
                ),
                'Implemented BCP plans, Scenario based Business continuity plans for departments, Emergency management plans. ' => array(
                    'Business Continuity Plan implementation'
                ),
            ),
            'Legal Assistant' => array(
                'Informing management on emerging issues on new legislation and developments on new developments by providing write ups and memos on emerging issues on legislation. ' => array(
                    'Advise management on new laws. '
                ),
                'Audits of the issues arising from the legal documents such as contracts. ' => array(
                    'Reviewing and Drafting legal documents such as Contracts, Non-Disclosure Agreements, and property acquisition documents including Heads of Terms, Leases and Licenses. '
                ),
                'Audit of the lease portfolio schedule acts as a “one-stop shop” on all lease and license related information. ' => array(
                    'Maintaining a lease portfolio schedule, which involves monitoring rental clauses on rent, escalation and lease expiry. '
                ),
                'Adherence to the judicial process to avoid hefty fines and penalties. ' => array(
                    'Keeping track of impending and ongoing law suits by liaising with external counsel and external sources such as insurance firms on any law suits filed by persons in the course of their dealings with us. And keeping electronic and hard copy record of every document pertaining to a law suit.'
                ),
                'Continuous good relationships between the Company and the Landlords.' => array(
                    'Advising Human Resource on legal challenges during employee hearings and providing advice to the panel on the best course of action that could result in the least amount of legal fall back for the company.'
                ),
                'Number of finalized registrations of trademarks.' => array(
                    'Attend external Tenant-Landlord meetings and brief management on the discussions and resolution of issues. ',
                    'Keep track of and write up briefs on the status of our Trademarks applications and coordinate the status progress of the applications in various jurisdictions'
                ),
            ),
            'Construction Site Engineer' => array(
                'Number of projects completed as per set timelines' => array(
                    'Follow up of  project timelines'
                ),
                'Number of projects completed within approved budget' => array(
                    'Monitoring variations during construction period'
                ),
                'Number of major snags.' => array(
                    'Thorough  supervision of the quality of executed works'
                ),
                'Number of branches completed before defects liability period.' => array(
                    'Follow up of snags/ punch list to their logical conclusion.'
                ),
                'Timely sending of accurate site reports' => array(
                    'Production of accurate records, drawing registers and weekly diaries'
                ),
            ),
            'Senior Maintenance Manager' => array(
                'Average 1.5% R&M expenditure against  revenue' => array(
                    'Drive cost efficiency in maintenance activities'
                ),
                'Achieve a staff utilization rate no less than 70%,non-active time no more than 30% within 24 months across' => array(
                    'Drive manpower utilization efficiency'
                ),
                'Quarterly PPM Completion rate of 85% ' => array(
                    'Execute the Planned Preventive Maintenance program in allocated facilities'
                ),
                'Monthly equipment availability of 85%' => array(
                    'Drive maximum equipment availability in allocated facilities'
                ),
            ),
            'Regional Maintenance Manager' => array(
                'Average 1.5% R&M expenditure against revenue' => array(
                    'Drive cost efficiency in maintenance activities'
                ),
                'Deliver an active man-hours ratio of 2:1preventive versus reactive maintenance' => array(
                    'Drive manpower utilization efficiency'
                ),
                'Achieve a staff utilization rate no less than 70%, non-active time no more than 30% within 24 months across' => array(
                    'Execute the Planned Preventive Maintenance program in allocated facilities'
                ),
                'Quarterly PPMCompletion rate of 85%' => array(
                    'Drive maximum equipment availability in allocated facilities'
                ),
                'Monthly equipment availability of 85%' => array(),
            ),
            'Technician III Refrigeration' => array(
                'Incident and accident rates for specific department' => array(
                    'Performs all relevant tasks in line with the trained standard operating procedures in order to minimize risk of harm to self, others or damage to property'
                ),
                'Number of initiatives and suggestions highlighted through communication cascade meetings or daily department briefings' => array(
                    'Supports the continuous improvement culture by highlighting areas of waste that when successfully addressed can lead to financial savings for the business'
                ),
            ),
            'Technician I Refrigeration' => array(
                'Incident and accident rates for specific department' => array(
                    'Performs all relevant tasks in line with the trained standard operating procedures in order to minimize risk of harm to self, others or damage to property'
                ),
                'Number of initiatives and suggestions highlighted through communication cascade meetings or daily department briefings' => array(
                    'Supports the continuous improvement culture by highlighting areas of waste that when successfully addressed can lead to financial savings for the business'
                ),
            ),
            'Technician III Electrical' => array(
                'Incident and accident rates for specific department' => array(
                    'Performs all relevant tasks in line with the trained standard operating procedures in order to minimize risk of harm to self, others or damage to property'
                ),
                'Number of initiatives and suggestions highlighted through communication cascade meetings or daily department briefings' => array(
                    'Supports the continuous improvement culture by highlighting areas of waste that when successfully addressed can lead to financial savings for the business'
                ),
            ),
            'Technician II Electrical' => array(
                'Incident and accident rates for specific department' => array(
                    'Performs all relevant tasks in line with the trained standard operating procedures in order to minimize risk of harm to self, others or damage to property'
                ),
                'Number of initiatives and suggestions highlighted through communication cascade meetings or daily department briefings' => array(
                    'Supports the continuous improvement culture by highlighting areas of waste that when successfully addressed can lead to financial savings for the business'
                ),
            ),
            'Technician I Electrical' => array(
                'Incident and accident rates for specific department' => array(
                    'Performs all relevant tasks in line with the trained standard operating procedures in order to minimize risk of harm to self, others or damage to property'
                ),
                'Number of initiatives and suggestions highlighted through communication cascade meetings or daily department briefings' => array(
                    'Supports the continuous improvement culture by highlighting areas of waste that when successfully addressed can lead to financial savings for the business'
                ),
            ),
            'Plumber II' => array(
                'Incident and accident rates for specific department' => array(
                    'Performs all relevant tasks in line with the trained standard operating procedures in order to minimize risk of harm to self, others or damage to property'
                ),
                'Number of initiatives and suggestions highlighted through communication cascade meetings or daily department briefings' => array(
                    'Supports the continuous improvement culture by highlighting areas of waste that when successfully addressed can lead to financial savings for the business'
                ),
            ),
            'Plumber I' => array(
                'Incident and accident rates for specific department' => array(
                    'Performs all relevant tasks in line with the trained standard operating procedures in order to minimize risk of harm to self, others or damage to property'
                ),
                'Number of initiatives and suggestions highlighted through communication cascade meetings or daily department briefings' => array(
                    'Supports the continuous improvement culture by highlighting areas of waste that when successfully addressed can lead to financial savings for the business'
                ),
            ),
            'Carpenter III' => array(
                'Incident and accident rates for specific department' => array(
                    'Performs all relevant tasks in line with the trained standard operating procedures in order to minimize risk of harm to self, others or damage to property'
                ),
                'Number of initiatives and suggestions highlighted through communication cascade meetings or daily department briefings' => array(
                    'Supports the continuous improvement culture by highlighting areas of waste that when successfully addressed can lead to financial savings for the business'
                ),
            ),
            'Carpenter I' => array(
                'Incident and accident rates for specific department' => array(
                    'Performs all relevant tasks in line with the trained standard operating procedures in order to minimize risk of harm to self, others or damage to property'
                ),
                'Number of initiatives and suggestions highlighted through communication cascade meetings or daily department briefings' => array(
                    'Supports the continuous improvement culture by highlighting areas of waste that when successfully addressed can lead to financial savings for the business'
                ),
            ),
            'Painter' => array(
                'Incident and accident rates for specific department' => array(
                    'Performs all relevant tasks in line with the trained standard operating procedures in order to minimize risk of harm to self, others or damage to property'
                ),
                'Number of initiatives and suggestions highlighted through communication cascade meetings or daily department briefings' => array(
                    'Supports the continuous improvement culture by highlighting areas of waste that when successfully addressed can lead to financial savings for the business'
                ),
            ),
            'Upholster' => array(
                'Completion of allocated preventive maintenance and reactive maintenance work within target timelines, as per agreed upon SOP’s' => array(
                    'Adherence to work schedules'
                ),
                'Accurate recording of all work done in checklists, timesheets and job cards' => array(),
                'No repeat jobs on work previously carried out' => array(
                    'Perform all work in line with trained SOPs and adherence to OSH procedures'
                ),
                'Reporting of safety incidences, dangerous situations, unsafe practices and unsafe equipment, fittings and fittings' => array(
                    'Correct use of PPE, tools and safe work practices in order to ensure safety of self and others'
                ),
            ),
            'Receptionist' => array(
                'Timely Payments' => array(
                    'Liaises with the finance manager in raising payment vouchers',
                    'Provide support to the finance department to ensure efficiency and effectiveness of payments in consultation with the finance manager'
                ),
                '100% compliance & availability of documents' => array(
                    'Coordinating and ensuring all finance filing is updated and in order'
                ),
                'On-time Delivery' => array(
                    'Assist in ensuring any general letters from finance department are done and delivered to the respective recipients'
                ),
                'Customer satisfaction' => array(
                    'Provide administrative support in the finance department'
                ),
            ),
            'Office Messenger' => array(
                'On-time Delivery' => array(
                    'Effective in Delivery and Trips Management'
                ),
                'Zero Accident / Incident Rates' => array(
                    'Effective Reporting'
                ),
                '100% conformance to Traffic Act & Regulations' => array(
                    'Effective Communication'
                ),
            ),
            'Stock Control & Compliance Accountant' => array(
                'Reduction in stock loss variances' => array(
                    'Stock management processing and accounting'
                ),
                'Effective communication of variance reports to management' => array(
                    'Stock variance analysis'
                ),
                'Good stock management' => array(
                    'Purchase and manufacturing variances '
                ),
                'ICS' => array(
                    'Receiving ',
                    'Product costing  '
                ),
            ),
            'Food Safety - Foodscape' => array(
                '100% implementation of quarterly internal audits) and follow up on CAP’s arising from the same.' => array(
                    'Effective resource management'
                ),
                '100% implementation of corrective actions resulting from audits and failed micro-analysis and ATP swab results.' => array(
                    'Audits'
                ),
                '100% compliance to food safety training schedules and induction training.' => array(
                    'Traceability'
                ),
                '100% traceability score within 2 hours during monthly traceability challenges' => array(
                    'Training'
                ),
                '100% follow up on filled FSR’s (Food safety reports) issued to suppliers for non-conformance arising to supplied products' => array(
                    'ATP & Micro testing of food , water & environmental swabs',
                    'Material specification for received items',
                    'Effective safety leadership',
                    'Effective communication'
                ),
            ),
            'Quality Assurance Supervisor - Foodscape' => array(
                '100% implementation of quarterly internal audits) and follow up on CAP’s arising from the same.' => array(
                    'Effective resource management'
                ),
                '100% implementation of corrective actions resulting from audits and failed micro-analysis and ATP swab results.' => array(
                    'Audits'
                ),
                '100% compliance to food safety training schedules and induction training.' => array(
                    'Traceability'
                ),
                '100% traceability score within 2 hours during monthly traceability challenges' => array(
                    'Training'
                ),
                '100% follow up on filled FSR’s (Food safety reports) issued to suppliers for non-conformance arising to supplied products' => array(
                    'ATP & Micro testing of food , water & environmental swabs',
                    'Material specification for received items',
                    'Effective safety leadership',
                    'Effective communication'
                ),
            ),
            'Finance Manager - Property & R&M' => array(
                'Accurate assessment of key performance ratios of the projects feasibility studies
' => array(
                    'Accurate assessment of key performance ratios of the projects feasibility studies	'
                ),
                'Accurate allocations of project transactions
' => array(
                    'Accurate allocations of project transactions'
                ),
                'Maintaining of the fixed asset register
' => array(
                    'Accurate business case'
                ),
                'Monitoring of R&M and IT expense allocations
' => array(
                    'Maintaining of the fixed asset register'
                ),
                'Full implementation of IFRS 16' => array(
                    'Monitoring of R&M and IT expense allocations'
                )
            ),
            'Regional Internal Auditor' => array(
                'At least 90% of audit assignments started and completed within set timelines.' => array(
                    ' Carries out audit assignments according to set and agreed standards'
                ),
                ' Completion of all assigned branch assessments.' => array(
                    ' Exercise probity'
                ),
                'High level of application of internal auditing standards & methodology including timely clearance of review queries.' => array(
                    ' Liaison with key staff to get information for audits and responses to queries',
                    ' Completion of support functions audit assignments within agreed timelines.',
                    ' Completion of branch reviews within the agreed timelines.',
                    ' Demonstrate continuous learning and improvement of skill in internal auditing.'
                ),
            ),
            'Commissary Accountant' => array(
                'Making sure all transactions are charged in MC at commissary ' => array(
                    'Overall in charge of commissary accounting and stock management '
                ),
                'By balancing off intercompany accounts on a monthly basis ' => array(
                    'Reconciliation of Intercompany Accounts'
                ),
                'Timely production of the variance report ' => array(
                    'Preparing and analyzing a monthly variance report '
                ),
                'All invoices are received timely/daily ' => array(
                    'Receiving stock invoices to VUKA'
                ),
                'Making sure that all bookings are done and CNs issued on time  ' => array(
                    'Management of transfers to branches and booking of the same '
                ),
                'Receiving and costing all imports timely and advising branches on the prices to use  ' => array(
                    'In charge of production and costing of food items from raw materials to finished products '
                ),
            ),
            'Coffee Sales & Merchandising Representative' => array(
                'Acceptable reach rate will yield 32% more business in our pipeline. ' => array(
                    'Reach rate '
                ),
                'Acceptable response time to any lead/follow up/inquiry should be at 95%. ' => array(
                    'Lead response time '
                ),
                'Acceptable ratio should 5:1 ' => array(
                    'Opportunity to win ratio'
                ),
                'Minimum acceptable level - 70% ' => array(
                    'Planning and reporting'
                )
            ),
            'Regional Systems Administrator' => array(
                '100% antivirus protection on all PCs, Laptops and Servers expected. ' => array(
                    'Ensure the application and database servers have up to date and compliant operating system. '
                ),
                '100% configuration and maintenance of computer related systems and hardware are working to the best industry standards. ' => array(
                    'Ensure users are fully supported on the existing application programs. '
                ),
                '100% data integrity, availability and security expected always. ' => array(
                    'Configuration, Monitoring, Administration of Branch Application programs. ',
                    'Maintain best industry standards for ICT systems and programs. General cleanliness of computer related hardware. '
                ),
            ),
            'Branch Accountant' => array(
                'Increased branch efficiency and favorable cost.' => array(
                    'Performs all relevant duties/responsibilities with little or no supervision with the ability to monitor all activities '
                ),
                'Improved performance across all the branch operations.' => array(
                    'Supervision of overall branch operations that affect the performance and bring suggestions that improve efficiency.'
                ),
                'Safe custody of branch monies.' => array(
                    'Flexibility to run more than one branch in different areas effectively.'
                ),
            ),
            'Commissary Supervisor' => array(
                '100% attainment of leading safety indicators (safety observations, audits and tool box talks) ' => array(
                    'Safety '
                ),
                '100% compliance to PPM schedule as set in the production plan, and as agreed between manufacturing and maintenance managers ' => array(
                    'Equipment availability '
                ),
                '100% compliance to the PD schedules as set by in the production plan and as agreed between the manufacturing and PD managers ' => array(
                    'Product development '
                ),
                '+/-0.25% variance against standard in regards materials and staffing ' => array(
                    'Financial performance '
                ),
                'To achieve less than 5 non conformance reports per month in regards quality and food safety related processes, and 100% root cause identification and resolution within 48 hours ' => array('Quality & food safety ', 'Inventory controls '),
            ),
            'Senior Storekeeper' => array(
                'Stock Out as a % ' => array(
                    'Effective Resource Management '
                ),
                'Order Fill Rate ' => array(
                    'Strong customer focus '
                ),
                'Inventory Accuracy ' => array(
                    'Effective safety leadership '
                ),
                'FIFO / FEFO Shelf-life Modelling ' => array(
                    'Effective communication  ',
                    'Conformance to training needs analysis '
                )
            ),
            'Team Member - Assistant Coffee Roaster' => array(
                'Variance of +/- 5% of process rates when measured against standard ' => array(
                    'Effective resource management '
                ),
                'Minimum of 97% DIFOT ' => array(
                    'Strong customer focus '
                ),
                '100% completion of daily safety inspections' => array(
                    'Effective safety leadership '
                ),
                '100% completion of tool box talks against the department comms schedule ' => array('Effective communication'),
                '100% conformance to the staff training needs analysis  ' => array(
                    'Conformance to training needs analysis '
                ),
            ),
            'Senior Controls Accountant' => array(
                'Daily, Weekly and monthly reports on Food and Beverage reports.' => array(
                    'Accurate and timely Food and Beverage reports.'
                ),
                'Timely petty cash reimbursements.' => array(
                    'Management of branch  accountant float'
                ),
                'Periodic Stocks efficiencies and stock reports.' => array(
                    'Ensure set policies and procedures are working and complied to.'
                ),
                'Continuous testing of set systems’ compliance through spot checks in branches and supervises training' => array(
                    'Ensure proper and continuous training is done to new accountants.'
                ),
                'Timely and accurate Petty cash postings.' => array(
                    'Posting petty cash in their accurate VUKA accounts'
                ),
            ),
            'Cost Controller' => array(
                'Daily, Weekly and monthly reports on Food and Beverage reports.' => array(
                    'Accurate and timely Food and Beverage reports.'
                ),
                'Timely petty cash reimbursements.' => array(
                    'Management of branch  accountant float'
                ),
                'Periodic Stocks efficiencies and stock reports.' => array(
                    'Ensure set policies and procedures are working and complied to.'
                ),
                'Continuous testing of set systems’ compliance through spot checks in branches and supervises training' => array(
                    'Ensure proper and continuous training is done to new accountants.'
                ),
                'Timely and accurate Petty cash postings.' => array(
                    'Posting petty cash in their accurate VUKA accounts'
                ),
            ),
            'Payroll Accountant' => array(
                'Meeting reporting deadlines' => array(
                    'Process payroll timeously'
                ),
                'Improved efficiency in payroll processing and payment' => array(
                    'Statutory  reconciliation and payment'
                ),
                'Successful implementation of the ERP' => array(
                    'Accurate keeping of employees details',
                    'Safeguarding data security ',
                    'Review system process flow for improved reporting'
                ),
            ),
            'Legal Officer' => array(
                'Informing management on emerging issues on new legislation and developments on new developments by providing write ups and memos on emerging issues on legislation. ' => array(
                    'Advise management on new laws. '
                ),
                'Audits of the issues arising from the legal documents such as contracts. ' => array(
                    'Reviewing and Drafting legal documents such as Contracts, Non-Disclosure Agreements, and property acquisition documents including Heads of Terms, Leases and Licenses. '
                ),
                'Audit of the lease portfolio schedule acts as a “one-stop shop” on all lease and license related information. ' => array(
                    'Maintaining a lease portfolio schedule, which involves monitoring rental clauses on rent, escalation and lease expiry. '
                ),
                'Adherence to the judicial process to avoid hefty fines and penalties. ' => array(
                    'Keeping track of impending and ongoing law suits by liaising with external counsel and external sources such as insurance firms on any law suits filed by persons in the course of their dealings with us. And keeping electronic and hard copy record of every document pertaining to a law suit.'
                ),
                'Continuous good relationships between the Company and the Landlords.' => array(
                    'Advising Human Resource on legal challenges during employee hearings and providing advice to the panel on the best course of action that could result in the least amount of legal fall back for the company.'
                ),
                'Number of finalized registrations of trademarks.' => array(
                    'Attend external Tenant-Landlord meetings and brief management on the discussions and resolution of issues. ',
                    'Keep track of and write up briefs on the status of our Trademarks applications and coordinate the status progress of the applications in various jurisdictions'
                ),
            ),
            'Kukito Crew Member' => array(
                'Net Promoter Score' => array(
                    'Attend to the tables and guarantee compliance to cleanliness standards'
                ),
                'Food Safety' => array(
                    'Ensure that the SOPs for restaurant hygiene are maintained and consistently adhered to in accordance to food safety requirements'
                ),
                'Integrity' => array(
                    'Ensure all company money is intact as transacted at all times and all transactions accompanied with  official receipts'
                ),
            ),
            'Team Member - Produce' => array(
                'The number of processes completed right first time, without the need for corrective action or rejection ' => array(
                    'Adherence to work schedules and performance criteria '
                ),
                'Incident and accident rates for specific department ' => array(
                    'Perform all work in line with trained SOPs and adherence to OSH procedures '
                ),
                'Achieve all PDP objectives as agreed with Team Leader ' => array(
                    'Delivery to customers in full and on time '
                ),
                'Number of suggestions or ideas shared. ' => array(
                    'To achieve satisfactory scores in all customer quality assessment measures  '
                ),
                '100% delivery in full and on time of manufactured items ' => array(),
                'Customer quality complaints not exceeding agreed targets ' => array(),
            ),
            'Team Member - Manufacturing' => array(
                'Variance of +0.5/-0.of process rates when measured against standard ' => array(
                    'SOP/ Work Instruction follow up '
                ),
                'Training attendance in a year ' => array(
                    'Undertake training to meet food legislation requirements. '
                ),
                'Safety reporting document ' => array(
                    'Reporting of safety incidences ',
                    'Attending the tool box talk '
                ),
            ),
            'Team Leader - Manufacturing' => array(
                'Variance of +/- 5% of process rates when measured against standard ' => array(
                    'Effective resource management '
                ),
                'Minimum of 97% DIFOT ' => array(
                    'Strong customer focus  '
                ),
                '100% completion of daily safety inspections ' => array(
                    'Effective safety leadership   '
                ),
                '100% completion of tool box talks against the department comms schedule ' => array(
                    'Effective communication  '
                ),
                '100% conformance to the staff training needs analysis ' => array(
                    'Conformance to training needs analysis '
                ),
            ),
            'Team Member - Manufacturing (Packer)' => array(
                'Variance of +0.5/-0.of process rates when measured against standard ' => array(
                    'SOP/ Work Instruction follow up '
                ),
                'Training attendance in a year ' => array(
                    'Undertake training to meet food legislation requirements. '
                ),
                'Safety reporting document ' => array(
                    'Reporting of safety incidences ',
                    'Attending the tool box talk '
                ),
            ),
            'Assistant Branch Manager' => array(
                'NPS' => array(
                    'Ensure guest’s satisfaction is met through consistently auditing the branch operations on a daily basis.'
                ),
                'Food Safety' => array(
                    'Enforce operational practices of the branch, making sure it runs smoothly and complies with food safety requirements.'
                ),
                'Integrity' => array(
                    'Training of Branch staff and coordinate their progress to ensure the set procedures are adhered to. '
                ),
                'Margins' => array(
                    'Directly involved in driving & analyzing the stores performance and ensure that the set budget is achieved on operational COS, sales and labor optimization.'
                ),
                'L4L sales' => array(
                    'Ensure that the par levels of both Crockery and Food/non-food items are adhered and encourage suggestive selling to maximize on revenue. '
                ),
            ),
            'Branch Supervisor' => array(
                'NPS' => array(
                    'Ensure guest’s satisfaction is met through consistently auditing the branch operations on a daily basis.'
                ),
                'Food Safety' => array(
                    'Enforce operational practices of the branch, making sure it runs smoothly and complies with food safety requirements.'
                ),
                'Integrity' => array(
                    'Training of Branch staff and coordinate their progress to ensure the set procedures are adhered to. '
                ),
                'Margins' => array(
                    'Directly involved in driving & analyzing the stores performance and ensure that the set budget is achieved on operational COS, sales and labor optimization.'
                ),
                'L4L sales' => array(
                    'Ensure that the par levels of both Crockery and Food/non-food items are adhered and encourage suggestive selling to maximize on revenue.'
                ),
            ),
            'Electrical Technician' => array(
                'Incident and accident rates for specific department' => array(
                    'Performs all relevant tasks in line with the trained standard operating procedures in order to minimize risk of harm to self, others or damage to property.'
                ),
                'Number of initiatives and suggestions highlighted through communication cascade meetings or daily department briefings' => array(
                    'Supports the continuous improvement culture by highlighting areas of waste that when successfully addressed can lead to financial savings for the business.'
                ),
            ),
        );

        // seed here
        foreach ($data as $userRole => $kras) {
            $role = Role::query()->firstOrCreate(
                ['slug' => Str::slug($userRole)],
                [
                    'name' => $userRole,
                    'description' => 'Give more details on what the ' . $userRole . ' does within the system.',
                    'level' => 3,
                ]
            );

            if ($role) {
                foreach ($kras as $kra => $kpis) {
                    $result = KeyResultArea::query()->updateOrCreate([
                        'slug' => Str::slug($kra . $role->name)
                    ], [
                        'name' => $kra
                    ]);

                    foreach ($kpis as $kpi) {
                        KeyPerformanceIndicator::query()->updateOrCreate([
                            'role_id' => $role->id,
                            'key_result_area_id' => $result->id,
                            'description' => $kpi
                        ]);
                    }
                }
            } else {
                Log::error('Create this role - ' . $userRole);
            }
        }
    }
}
