<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\State;
use Illuminate\Database\Seeder;

class HindiTranslationSeeder extends Seeder
{
    public function run(): void
    {
        // Hindi translations for Categories
        $categoryHi = [
            'education' => ['name_hi' => 'शिक्षा', 'description_hi' => 'छात्रवृत्ति, विद्यालय योजनाएं, उच्च शिक्षा सब्सिडी और कौशल विकास कार्यक्रम।'],
            'health' => ['name_hi' => 'स्वास्थ्य', 'description_hi' => 'स्वास्थ्य बीमा, अस्पताल योजनाएं, चिकित्सा सब्सिडी और कल्याण कार्यक्रम।'],
            'agriculture' => ['name_hi' => 'कृषि', 'description_hi' => 'किसान सब्सिडी, फसल बीमा, सिंचाई योजनाएं और किसान कल्याण कार्यक्रम।'],
            'housing' => ['name_hi' => 'आवास', 'description_hi' => 'सस्ता आवास, गृह ऋण सब्सिडी और शहरी/ग्रामीण आवास योजनाएं।'],
            'employment' => ['name_hi' => 'रोजगार', 'description_hi' => 'रोजगार सृजन, स्वरोजगार, कौशल प्रशिक्षण और स्टार्टअप फंडिंग योजनाएं।'],
            'social-welfare' => ['name_hi' => 'सामाजिक कल्याण', 'description_hi' => 'पेंशन योजनाएं, विकलांगता सहायता, वरिष्ठ नागरिक कल्याण और सामाजिक सुरक्षा।'],
            'women-child' => ['name_hi' => 'महिला एवं बाल विकास', 'description_hi' => 'महिला सशक्तिकरण, बाल संरक्षण, मातृत्व लाभ और बालिका योजनाएं।'],
            'financial-inclusion' => ['name_hi' => 'वित्तीय समावेश', 'description_hi' => 'बैंकिंग योजनाएं, बीमा, पेंशन और वित्तीय साक्षरता कार्यक्रम।'],
            'digital-india' => ['name_hi' => 'डिजिटल इंडिया', 'description_hi' => 'डिजिटल साक्षरता, इंटरनेट पहुंच,�-गवर्नेंस और प्रौद्योगिकी योजनाएं।'],
            'infrastructure' => ['name_hi' => 'अवसंरचना', 'description_hi' => 'सड़क, जल आपूर्ति, विद्युतीकरण और स्मार्ट सिटी विकास योजनाएं।'],
            'environment' => ['name_hi' => 'पर्यावरण', 'description_hi' => 'स्वच्छ ऊर्जा, प्रदूषण नियंत्रण, जल संरक्षण और हरित पहल।'],
            'senior-citizen' => ['name_hi' => 'वरिष्ठ नागरिक', 'description_hi' => 'पेंशन, स्वास्थ्य सेवा, यात्रा छूट और बुजुर्ग नागरिकों के लिए कल्याण।'],
        ];

        foreach ($categoryHi as $slug => $data) {
            Category::where('slug', $slug)->update($data);
        }

        // Hindi translations for States (sample - key states)
        $stateHi = [
            'central-government' => 'केंद्र सरकार',
            'andhra-pradesh' => 'आंध्र प्रदेश',
            'arunachal-pradesh' => 'अरुणाचल प्रदेश',
            'assam' => 'असम',
            'bihar' => 'बिहार',
            'chhattisgarh' => 'छत्तीसगढ़',
            'goa' => 'गोवा',
            'gujarat' => 'गुजरात',
            'haryana' => 'हरियाणा',
            'himachal-pradesh' => 'हिमाचल प्रदेश',
            'jharkhand' => 'झारखंड',
            'karnataka' => 'कर्नाटक',
            'kerala' => 'केरल',
            'madhya-pradesh' => 'मध्य प्रदेश',
            'maharashtra' => 'महाराष्ट्र',
            'manipur' => 'मणिपुर',
            'meghalaya' => 'मेघालय',
            'mizoram' => 'मिज़ोरम',
            'nagaland' => 'नागालैंड',
            'odisha' => 'ओडिशा',
            'punjab' => 'पंजाब',
            'rajasthan' => 'राजस्थान',
            'sikkim' => 'सिक्किम',
            'tamil-nadu' => 'तमिल नाडु',
            'telangana' => 'तेलंगाना',
            'tripura' => 'त्रिपुरा',
            'uttar-pradesh' => 'उत्तर प्रदेश',
            'uttarakhand' => 'उत्तराखंड',
            'west-bengal' => 'पश्चिम बंगाल',
            'andaman-and-nicobar-islands' => 'अंडमान और निकोबार द्वीप समूह',
            'chandigarh' => 'चंडीगढ़',
            'dadra-and-nagar-haveli-and-daman-and-diu' => 'ददरा और नागर हवेली और दमन और दीव',
            'delhi' => 'दिल्ली',
            'jammu-and-kashmir' => 'जम्मू और कश्मीर',
            'ladakh' => 'लद्दाख',
            'lakshadweep' => 'लक्षद्वीप',
            'puducherry' => 'पुडुचेरी',
        ];

        foreach ($stateHi as $slug => $nameHi) {
            State::where('slug', $slug)->update(['name_hi' => $nameHi]);
        }
    }
}
