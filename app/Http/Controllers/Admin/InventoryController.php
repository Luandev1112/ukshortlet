<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $search_stock = $request->stock_code;
        $update_day = $request->update_day;
        $cond = null;
        if($search_stock)
        {
            $cond['stock_code'] = $search_stock;
        }
        if($update_day)
        {
            $update_day = date('Y-m-d', strtotime($update_day));
            $cond['update_day'] = $update_day;
            // $update_day = date('m/d/Y', strtotime($update_day));
        }
        $page_title = 'Inventories Data';
        $empty_message = 'No Data found.';
        $category_items = Inventory::groupBy('stock_code')->get('stock_code');
        if($cond)
        {
            $items = Inventory::where($cond)->latest()->paginate(getPaginate());
        }else{
            $items = Inventory::latest()->paginate(getPaginate());
        }
        // dd($update_day);
        
        return view('admin.inventory.index', compact('items', 'page_title','empty_message', 'category_items', 'search_stock', 'update_day'));
    }

    public function import(Request $request)
    {
        $path = $request->file('csv_file')->getRealPath();
        $data_arr = array_map('str_getcsv', file($path));
        for ($i = 0; $i < count($data_arr); $i++) {
            $data = $data_arr[$i];
            if($i > 0)
            {
                $data_cond['stock_code'] = $data[3];
                $data_cond['fwpe'] = $data[6];
                $data_cond['update_day'] = date('Y-m-d', strtotime($data[29]));
                $inventory = Inventory::where($data_cond)->count();
                if($inventory == 0)
                {
                    $inventory = new Inventory();
                    $inventory->created_at = date('Y-m-d H:i:s', strtotime($data[0]));
                    $inventory->updated_at = date('Y-m-d H:i:s', strtotime($data[1]));
                    $inventory->stock_code = $data[2];
                    if($inventory->stock_code == '')
                        continue ;

                    $inventory->eps = str_replace(",","",$data[3]);
                    if($inventory->eps == '' || (int)$inventory->eps == 0)
                        continue ;
                    $inventory->pe = str_replace(",","",$data[4]);
                    if($inventory->pe == '' || (int)$inventory->pe == 0)
                        continue ;
                    $inventory->fwpe = str_replace(",","",$data[5]);
                    if($inventory->fwpe == '' || (int)$inventory->fwpe == 0)
                       continue ;
                    $inventory->doanh_thu_quy_gan_nhat = str_replace(",","",$data[6]);
                    if($inventory->doanh_thu_quy_gan_nhat == '' || (int)$inventory->doanh_thu_quy_gan_nhat == 0)
                       continue ;
                    $inventory->doanh_thu_quy_truoc_gan_nhat = str_replace(",","",$data[7]);
                    if($inventory->doanh_thu_quy_truoc_gan_nhat == '' || (int)$inventory->doanh_thu_quy_truoc_gan_nhat == 0)
                       continue ;
                    $inventory->doanh_thu_quy_cung_ky_nam_truoc = str_replace(",","",$data[8]);
                    if($inventory->doanh_thu_quy_cung_ky_nam_truoc == '' || (int)$inventory->doanh_thu_quy_cung_ky_nam_truoc == 0)
                       continue ;
                    $inventory->loi_nhuan_sau_thue_quy_gan_nhat = str_replace(",","",$data[9]);
                    if($inventory->loi_nhuan_sau_thue_quy_gan_nhat == '' || (int)$inventory->loi_nhuan_sau_thue_quy_gan_nhat == 0)
                       continue ;
                    $inventory->loi_nhuan_sau_thue_quy_truoc_gan_nhat = str_replace(",","",$data[10]);
                    if($inventory->loi_nhuan_sau_thue_quy_truoc_gan_nhat == '' || (int)$inventory->loi_nhuan_sau_thue_quy_truoc_gan_nhat == 0)
                       continue ;
                    $inventory->loi_nhuan_sau_thue_quy_cung_ky_nam_truoc = str_replace(",","",$data[11]);
                    if($inventory->loi_nhuan_sau_thue_quy_cung_ky_nam_truoc == '' || (int)$inventory->loi_nhuan_sau_thue_quy_cung_ky_nam_truoc == 0)
                       continue ;

                    $inventory->eps_4_quy_gan_nhat = str_replace(",","",$data[12]);
                    if($inventory->eps_4_quy_gan_nhat == '' || (int)$inventory->eps_4_quy_gan_nhat == 0)
                       continue ;
                    $inventory->bvps_co_ban = str_replace(",","",$data[13]);
                    if($inventory->bvps_co_ban == '' || (int)$inventory->bvps_co_ban == 0)
                       continue ;
                    $inventory->pe_co_ban = str_replace(",","",$data[14]);
                    if($inventory->pe_co_ban == '' || (int)$inventory->pe_co_ban == 0)
                       continue ;
                    $inventory->roea = str_replace(",","",$data[15]);
                    if($inventory->roea == '' || (int)$inventory->roea == 0)
                       continue ;
                    $inventory->roaa = str_replace(",","",$data[16]);
                    if($inventory->roaa == '' || (int)$inventory->roaa == 0)
                       continue ;
                    $inventory->tong_tai_san = str_replace(",","",$data[17]);
                    if($inventory->tong_tai_san == '' || (int)$inventory->tong_tai_san == 0)
                       continue ;
                    $inventory->tong_no = str_replace(",","",$data[18]);
                    if($inventory->tong_no == '' || (int)$inventory->tong_no == 0)
                       continue ;
                    $inventory->von_hoa = str_replace(",","",$data[19]);
                    if($inventory->von_hoa == '' || (int)$inventory->von_hoa == 0)
                       continue ;
                    $inventory->khoi_luong_giao_dich = str_replace(",","",$data[20]);


                    if($inventory->khoi_luong_giao_dich == '' || (int)$inventory->khoi_luong_giao_dich == 0)
                       continue ;
                    $inventory->original_price = str_replace(",","",$data[21]);
                    if($inventory->original_price == '' || (int)$inventory->original_price == 0)
                       continue ;
                    $inventory->PEIM_PE = str_replace(",","",$data[22]);
                    if($inventory->PEIM_PE == '' || (int)$inventory->PEIM_PE == 0)
                       continue ;
                    $inventory->industry_trend = str_replace(",","",$data[23]);
                    if($inventory->industry_trend == '' || (int)$inventory->industry_trend == 0)
                       continue ;
                    $inventory->push_trend = str_replace(",","",$data[24]);
                    if($inventory->push_trend == '' || (int)$inventory->push_trend == 0)
                       continue ;

                    $inventory->finance_of_company_performance = str_replace(",","",$data[25]);
                    if($inventory->finance_of_company_performance == '' || (int)$inventory->finance_of_company_performance == 0)
                       continue ;
                    $inventory->leaders_reputation_impact = str_replace(",","",$data[26]);
                    if($inventory->leaders_reputation_impact == '' || (int)$inventory->leaders_reputation_impact == 0)
                       continue ;

                    $inventory->share_code = str_replace(",","",$data[27]);
                    $inventory->update_day = date('Y-m-d', strtotime($data[28]));
                    if($data[28] == '')
                       continue ;

                    $inventory->current_price = str_replace(",","",$data[29]);
                    if($inventory->current_price == '' || (int)$inventory->current_price == 0)
                       continue ;
                    $inventory->sell_price = str_replace(",","",$data[30]);
                    if($inventory->sell_price == '' || (int)$inventory->sell_price == 0)
                       continue ;

                    $inventory->flag_active = $data[31];
                    $inventory->expected_price = $data[32];
                    $inventory->interest = $data[33];
                    $inventory->interest_price = $data[34];

                    $inventory->save();
                }
            }
        }

        return redirect('admin/inventories');
    }

    public function ticketDownload($ticket_id)
    {
        $attachment = SupportAttachment::findOrFail(decrypt($ticket_id));
        $file = $attachment->image;


        $path = imagePath()['ticket']['path'];

        $full_path = $path.'/' . $file;
        $title = str_slug($attachment->supportMessage->ticket->subject).'-'.$file;
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $mimetype = mime_content_type($full_path);
        header('Content-Disposition: attachment; filename="' . $title);
        header("Content-Type: " . $mimetype);
        return readfile($full_path);
    }

    public function inventoryDelete(Request $request)
    {
        $message = SupportMessage::findOrFail($request->message_id);
        $path = imagePath()['ticket']['path'];
        if ($message->attachments()->count() > 0) {
            foreach ($message->attachments as $img) {
                @unlink($path.'/'.$img->image);
                $img->delete();
            }
        }
        $message->delete();
        $notify[] = ['success', "Delete Successfully"];
        return back()->withNotify($notify);

    }

    public function inventoryData(Request $request, $id)
    {
        $inventory = Inventory::findOrFail($id);
        return response()->json(['data'=>$inventory]);
    }

    public function getByStockCode(Request $request)
    {
        $stock_code = $request->stock_code;
        $up_day = $request->update_date;
        if($up_day){
            $update_date = date('Y-m-d H:i:s', strtotime($request->update_date));
            $results = DB::select('select * from main where stock_code = "'.$stock_code.'" ORDER BY ABS( DATEDIFF( update_day, "'.$update_date.'" ) )') ;
        }else{
           $results = Inventory::where('stock_code', $stock_code)->orderBy('update_day', 'DESC')->get();
        }
        if(count($results) > 0)
        {
            $result = $results[0];
        }else{
            $result = null;
        }
        return response()->json(['data'=>$result]);

    }

    public function inventoryUpdate(Request $request)
    {
        $id = $request->id;
        $inventory = Inventory::findOrFail($id);
        if($inventory)
        {
            $inventory->update_day = date('Y-m-d', strtotime($request->update_date));
            $inventory->stock_code = $request->stock_code;
            $inventory->industry_trend = $request->industry_trend;
            $inventory->finance_of_company_performance = $request->finance_performance;
            $inventory->leaders_reputation_impact = $request->reputation;
            $inventory->push_trend = $request->push_trend;
            $inventory->expected_price = $inventory->eps * $inventory->industry_trend;
            $inventory->interest_price = $inventory->expected_price / $inventory->current_price;
            $inventory->interest = $inventory->interest_price * 100;
            $inventory->save();
        }
        return redirect('admin/inventories');
    }

    public function updateStockCode(Request $request)
    {
        $id = $request->id;
        $inventory = Inventory::findOrFail($id);
        if($inventory)
        {
            $inventory->update_day = date('Y-m-d', strtotime($request->update_day));
            $inventory->stock_code = $request->stock_code;
            $inventory->industry_trend = $request->industry_trend;
            $inventory->finance_of_company_performance = $request->finance_of_company_performance;
            $inventory->leaders_reputation_impact = $request->leaders_reputation_impact;
            $inventory->push_trend = $request->push_trend;
            $inventory->expected_price = $inventory->eps * $inventory->industry_trend;
            $inventory->interest_price = $inventory->expected_price / $inventory->current_price;
            $inventory->interest = $inventory->interest_price * 100;
            $inventory->save();
        }
        return response()->json(['status'=>'success']);
    }
}
