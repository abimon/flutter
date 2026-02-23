<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CallAssignment;
use App\Models\Contribution;

class WeddingController extends Controller
{
    /**
     * Show the wedding page
     */
    public function index()
    {
        // Generate QR code URL using QR Server API (free service)
        $uploadUrl = route('wedding.upload-form');
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($uploadUrl);

        // Get uploaded photos
        $photos = [];
        if (Storage::disk('public')->exists('wedding-photos')) {
            $files = Storage::disk('public')->files('wedding-photos');
            // Sort by newest first
            rsort($files);
            $photos = array_map(function ($file) {
                $path = Storage::disk('public')->url($file);
                $image = explode('/', $path);
                return '/storage/wedding-photos/' . end($image);
            }, $files);
            // return $photos;
        }

        // Get config values
        $config = config('wedding');

        return view('wedding.index', [
            'qrCodeUrl' => $qrCodeUrl,
            'photos' => $photos,
            'weddingDate' => $config['date'],
            'weddingTime' => $config['time'],
            'venue' => $config['venue_name'],
            'venue_address' => $config['venue_address'],
            'contributionGoal' => $config['honeymoon']['goal'],
            'contributionCurrent' => Contribution::sum('amount'),
            'currency' => $config['honeymoon']['currency'],
            'brideInfo' => $config['bride'],
            'groomInfo' => $config['groom'],
            'honeymoonInfo' => $config['honeymoon'],
        ]);
    }

    /**
     * Show upload form (for QR code access)
     */
    public function uploadForm()
    {
        return view('wedding.upload-form');
    }

    /**
     * Handle photo upload
     */
    public function upload(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('wedding-photos', $filename, 'public');

            return response()->json([
                'success' => true,
                'message' => 'Photo uploaded successfully!',
                'filename' => $filename
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Failed to upload photo'
        ], 400);
    }

    /**
     * Get contribution progress
     */
    public function getProgress()
    {
        $config = config('wedding');
        $goal = $config['honeymoon']['goal'];
        $current = $config['honeymoon']['current'];

        return response()->json([
            'goal' => $goal,
            'current' => $current,
            'percentage' => round(($current / $goal) * 100, 2)
        ]);
    }

    /**
     * Display call center form and results based on phone number
     */
    public function callCenter(Request $request)
    {
        // if the form was submitted, look up assignments
        $assignments = null;
        $phone = null;

        if ($request->isMethod('post')) {
            $phone = $request->validate([
                'phone' => 'required|string'
            ])['phone'];

            $assignments = CallAssignment::where('caller_phone', $phone)->get();
        }

        return view('wedding.call-center', [
            'assignments' => $assignments,
            'phone' => $phone,
        ]);
    }
    function assignCallers()
    {
        $contacts = [
            ['+254795152945', 'Alvin Ombasa'],
            ['+254794127684', 'Asnath Mandera'],
            ['+254719495455', 'Augustus Kioko'],
            ['+254741197557', 'Austine Tintin'],
            ['+254748695700', 'Awech'],
            ['+254768402588', 'Basil'],
            ['+254728055997', 'Becky Nyabuto'],
            ['+254703130739', 'Bitengo Vivian'],
            ['+254743761460', 'Bius Michael'],
            ['+254797541424', 'Boaz Deacon'],
            ['+254713165297', 'Brian David'],
            ['+254707287413', 'Brian Gionga'],
            ['+254713423728', 'Brian Mboya'],
            ['+254717802185', 'Brian Onchwari'],
            ['+254797993934', 'Brian Oseko'],
            ['+254725964014', 'Bruce'],
            ['+254742338195', 'Casmmy Edward'],
            ['+254110559968', 'Chardwick Omondi Otieno'],
            ['+254723966008', 'Collins Bigogo'],
            ['+254713316172', 'Daisy'],
            ['+254793594870', 'Daphine'],
            ['+254716929749', 'David Elvis'],
            ['+254703388373', 'David Opany'],
            ['+254746073277', 'Desmond Onum'],
            ['+254737770022', 'Dir. Walter'],
            ['+254740461253', 'Mike Odhiambo'],
            ['+254758966643', 'Dr.Claire'],
            ['+254724419039', 'Duke Othoya'],
            ['+254715451670', 'Edwin Mambo'],
            ['+254725491803', 'Eko Lipo'],
            ['+254703633618', 'Elder Kuyo Kuyo Moses'],
            ['+254768069242', 'Elijah'],
            ['+254700712666', 'Elizabeth Makori'],
            ['+254796862100', 'Elvine Kwamboka'],
            ['+254717470579', 'Elvis Swanya'],
            ['+254114130372', 'Emason Munene'],
            ['+254796366545', 'Emily Aluoch'],
            ['+254715031000', 'Enock Omonywa'],
            ['+254111815183', 'Ephraim Nyankoya'],
            ['+254798392847', 'Eunice'],
            ['+254728270224', 'Ev Sam Maugo'],
            ['+254113751992', 'Faith Aburi'],
            ['+254719658919', 'Faith Chepkyony'],
            ['+254708166802', 'Faith Mwanah'],
            ['+254745446264', 'Felix Adem'],
            ['+254706955079', 'Flociah Benerd'],
            ['+254740415588', 'Florence Kaumbi'],
            ['+254111378252', 'Genga'],
            ['+254700325628', 'Gichana'],
            ['+254708871348', 'Gideon Kenyatta'],
            ['+254714582228', 'Grace Nyakerario'],
            ['+254708469128', 'Grace Wakiaga'],
            ['+254705108358', 'Hollyston Obonyo'],
            ['+254714584138', 'Ibrahim'],
            ['+254720701995', 'Issabella Jackson'],
            ['+254710774738', 'Ivy Getanda'],
            ['+254792384825', 'Jack Ojijo'],
            ['+254759152492', 'Jebichii'],
            ['+254795096433', 'Justine Orutwa'],
            ['+254794659329', 'Joakim'],
            ['+254703784900', 'Joan Okumu'],
            ['+254728047421', 'Job Omenta'],
            ['+254706948371', 'Job Omwamba'],
            ['+254791813114', 'Joshua Abaki'],
            ['+254798853059', 'Joshua Kwemboi'],
            ['+254746557988', 'Josphat Mwangi'],
            ['+254701925247', 'Joy Mundhe'],
            ['+254708087048', 'Jusper'],
            ['+254100596939', 'Justine'],
            ['+254722543167', 'Justus'],
            ['+254741747953', 'Kelvin Kamau'],
            ['+254702856210', 'Kenny Nderi'],
            ['+254712245749', 'Kevin Nyagwachi'],
            ['+254718394872', 'Spencer'],
            ['+254716032825', 'Lewis Mucomba'],
            ['+254742761211', 'Lilian Maina'],
            ['+254705977834', 'Lizzy Logan'],
            ['+254714022869', 'Maragia'],
            ['+254703747527', 'Marvin'],
            ['+254746704578', 'Maxwell Mutua'],
            ['+254110000212', 'Mech Allan'],
            ['+254725813261', 'Mwegi'],
            ['+254705001963', 'Newton Amis'],
            ['+254726399164', 'Nimrod Manduku'],
            ['+254796635722', 'Nyanchera Grace'],
            ['+254795044356', 'Ochami Ian'],
            ['+254793980555', 'Ogola Brandon'],
            ['+254745366628', 'Okwiri Herald'],
            ['+254740444925', 'Oscar Omullo'],
            ['+254712166671', 'Oula Malit'],
            ['+254797716888', 'Owuor'],
            ['+254112228252', 'Pauline'],
            ['+254715527406', 'Peris Bosibori'],
            ['+254714260706', 'Peris Wayodi'],
            ['+254717268689', 'Phostine Kwamboka'],
            ['+254742841460', 'Piffon'],
            ['+254701701861', 'Purity Moraa'],
            ['+254757694451', 'Purity Kefa'],
            ['+254797590515', 'Robert'],
            ['+254740943853', 'Rose Ouya'],
            ['+254759213019', 'Roy'],
            ['+254741404366', 'Prisca Kemunto'],
            ['+254701301228', 'Samson Rasugu'],
            ['+254794487120', 'Samuel Odira'],
            ['+254703468753', 'Sarah Thoya'],
            ['+254728315276', 'Shadrach Mbeche'],
            ['+254745905055', 'Sharon Monyenye'],
            ['+254718773973', 'Solomon Machora'],
            ['+254717613059', 'Son Nyataige'],
            ['+254111740816', 'Stephen Mboya'],
            ['+254718440770', 'Sydney'],
            ['+254721518486', 'Thomas Mwenda'],
            ['+254746426925', 'Tom Makambi'],
            ['+254745200041', 'Tom Ochieng'],
            ['+254795186531', 'Tonny Odhiambo'],
            ['+254741162231', 'Tonny Opiyo'],
            ['+254727949884', 'Tr. Jullie'],
            ['+254799603879', 'Valentine Kerry'],
            ['+254719575436', 'Valentine Vudembu'],
            ['+254717738125', 'Vera Kemunto'],
            ['+254710989566', 'Wamanya Juniour'],
            ['+254705898740', 'Wanyaga Faith'],
            ['+254746190734', 'Wellington'],
            ['+254706443935', 'Wesley Marube'],
            ['+254757625089', 'Willis Otieno'],
            ['+254790923668', 'Xavier Onyangi'],
            ['+254728795174', 'Yator Brian'],
            ['+254703211768', 'Yohana'],
            ['+254725164696', 'Zaddock'],
            ['+254714083757', 'Zeky Mutai'],
            ['+254111790783', 'Zena Atieno'],
            ['+254705484849', 'Alex Odhiambo'],
            ['+254758858331', 'Hillary Awidhi'],
            ['+254740941047',    ''],
            ['+254705120562',    ''],
            ['+254790448774',    ''],
            ['+254768215451',    ''],
            ['+254703892323',    ''],
            ['+254721280068',    ''],
            ['+254797436080',    ''],
            ['+254716192091',    ''],
            ['+254713517100',    ''],
            ['+254115555284',    ''],
            ['+254746055459',    ''],
            ['+254725681302',    ''],
            ['+254703959552',    ''],
            ['+254701134803',    ''],
            ['+254700662601',    ''],
            ['+254791579342',    ''],
            ['+254799636533',    ''],
            ['+254113036056',    ''],
            ['+254781263000',    ''],
            ['+254724582428',    ''],
            ['+254769816381',    ''],
            ['+254702982436',    ''],
            ['+254110580621',    ''],
            ['+254742866622',    ''],
            ['+254768075677',    ''],
            ['+254701896105',    ''],
            ['+254798803043',    ''],
            ['+254791303312',    ''],
            ['+254725892551',    ''],
            ['+254791593569',    ''],
            ['+254704675094',    ''],
            ['+254745863676',    ''],
            ['+254706655745',    ''],
            ['+254728474053',    ''],
            ['+254759358334',    ''],
            ['+254721147523',    ''],
            ['+254729900105',    ''],
            ['+254711628706',    ''],
            ['+254799247385',    ''],
            ['+254113703374',    ''],
            ['+254741661450',    ''],
            ['+254799601015',    ''],
            ['+254706546240',    ''],
            ['+254706637954',    ''],
            ['+254790587828',    ''],
            ['+254723828677',    ''],
            ['+254748832526',    ''],
            ['+254725713427',    ''],
            ['+254795550350',    ''],
            ['+254717152881',    ''],
            ['+254705499823',    ''],
            ['+254708735544',    ''],
            ['+254714777183',    ''],
            ['+254752302824',    ''],
            ['+254727507032',    ''],
            ['+254713918662',    ''],
            ['+254727384772',    ''],
            ['+254796029827',    ''],
            ['+254701288115',    ''],
            ['+254714285614',    ''],
            ['+254751003579',    ''],
            ['+254717657667',    ''],
            ['+254742146825',    ''],
            ['+254740880725',    ''],
            ['+254799954004',    ''],
            ['+254702238111',    ''],
            ['+254112427862',    ''],
            ['+254720582397',    ''],
            ['+254725997484',    ''],
            ['+254703164403',    ''],
            ['+254791646025',    ''],
            ['+254701284969',    ''],
            ['+254115840663',    ''],
            ['+254704153253',    ''],
            ['+254792212776',    ''],
            ['+254794727009',    ''],
            ['+254700562122',    ''],
            ['+254715670545',    ''],
            ['+254740568561',    ''],
            ['+254704449023',    ''],
            ['+254797784283',    ''],
            ['+254769706971',    ''],
            ['+254757605922',    ''],
            ['+254769329550',    ''],
            ['+254741556808',    ''],
            ['+254719510252',    ''],
            ['+254798520081',    ''],
            ['+254726263142',    ''],
            ['+254799919471',    ''],
            ['+254740754199',    ''],
            ['+254110553373',    ''],
            ['+254111475222',    ''],
            ['+254719505438',    ''],
            ['+254748029595',    ''],
            ['+254745078995',    ''],
            ['+254792222084',    ''],
            ['+254704230352',    ''],
            ['+254723832574',    ''],
            ['+254757965824',    ''],
            ['+254702248636',    ''],
            ['+254748671348',    ''],
            ['+254718192277',    ''],
            ['+254750111331',    ''],
            ['+254737201048',    ''],
            ['+254702612628',    ''],
            ['+254721661323',    ''],
            ['+254758609654',    ''],
            ['+254799715995',    ''],
            ['+254716477961',    ''],
            ['+254799226286',    ''],
            ['+254736415070',    ''],
            ['+254795836283',    ''],
            ['+254726998196',    ''],
            ['+254792218632',    ''],
            ['+254707520123',    ''],
            ['+254719378423',    ''],
            ['+254701025432',    ''],
            ['+254104974542',    ''],
            ['+254758748197',    ''],
            ['+254799072177',    ''],
            ['+254704958393',    ''],
            ['+254722968255',    ''],
            ['+254795590413',    ''],
            ['+254708936944',    ''],
            ['+254708820695',    ''],
            ['+254711213887',    ''],
            ['+254108096332',    ''],
            ['+254115997151',    ''],
            ['+254722441038',    ''],
            ['+254712658125',    ''],
            ['+254702674563',    ''],
            ['+254795027247',    ''],
            ['+254701282429',    ''],
            ['+254783424890',    ''],
            ['+254724316012',    ''],
            ['+254746285570',    ''],
            ['+254711524848',    ''],
            ['+254792284150',    ''],
            ['+254715215979',    ''],
            ['+254769963426',    ''],
            ['+254759258438',    ''],
            ['+254717034587',    ''],
            ['+254110522747',    ''],
            ['+254705013216',    ''],
            ['+254706041231',    ''],
            ['+254770056684',    ''],
            ['+254727447698',    ''],
            ['+254745377309',    ''],
            ['+254759167530',    ''],
            ['+254704003232',    ''],
            ['+254791009385',    ''],
            ['+254793053689',    ''],
            ['+254790811232',    ''],
            ['+254799222151',    ''],
            ['+254743223688',    ''],
            ['+254702050142',    ''],
            ['+254722128180',    ''],
            ['+254789903851',    ''],
            ['+254119829593',    ''],
            ['+254116244266',    ''],
            ['+254714311194',    ''],
            ['+254759830501',    ''],
            ['+254740306475',    ''],
            ['+254748059723',    ''],
            ['+254799903741',    ''],
            ['+254743196434',    ''],
            ['+254795296977',    ''],
            ['+254716601990',    ''],
            ['+254741937085',    ''],
            ['+254115219827',    ''],
            ['+254112549550',    ''],
            ['+254773700051',    ''],
            ['+254720977711',    ''],
            ['+254710903817',    ''],
            ['+254798856369',    ''],
            ['+254710580491',    ''],
            ['+254702280960',    ''],
            ['+254757611445',    ''],
            ['+254790015607',    ''],
            ['+254794288586',    ''],
            ['+254715687604',    ''],
            ['+254707462982',    ''],
            ['+254710578539',    ''],
            ['+254796547953',    ''],
            ['+254759464894',    ''],
            ['+254726376277',    ''],
            ['+254791885221',    ''],
            ['+254724413774',    ''],
            ['+254798217776',    ''],
            ['+254714111632',    ''],
            ['+254706889826',    ''],
            ['+254707826357',    ''],
            ['+254743640688',    ''],

        ];
        $callers = [
            'Delvin',
            'Faith Aburi',
            'Enock Reuben',
            'Valentine',
            'Yuna',
            'Ephraim',
            'Asenath',
        ];
        $n = count($callers);
        $result = $this->partition($contacts, $n);
        foreach ($result as $index => $group) {
            foreach ($group as $contact) {
                CallAssignment::updateOrCreate([
                    'contact_phone' => $contact[0],
                ], [
                    'contact_name' => $contact[1],
                    'caller_phone' => $callers[$index]
                ]);
            }
        }
        return CallAssignment::all();
    }
    function partition(array $list, int $p): array
    {
        $listlen = count($list);
        if ($p <= 0 || $listlen === 0) {
            return [];
        }

        $partlen = floor($listlen / $p);
        $partrem = $listlen % $p;
        $partition = [];
        $mark = 0;

        for ($px = 0; $px < $p; $px++) {
            $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
            $partition[$px] = array_slice($list, $mark, $incr);
            $mark += $incr;
        }

        return $partition;
    }
    function updateCallResponse($id)
    {
        $assignment = CallAssignment::findOrFail($id);
        if(request('response') != null){
            $assignment->response = request('response');
        }
        if(request('contact_name') != null){
            $assignment->contact_name = request('contact_name');
        }
        $assignment->update();
        return back()->with('success' , 'Response updated successfully');
    }
}
