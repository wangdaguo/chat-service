<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: ResultResponse.proto

namespace GPBMetadata;

class ResultResponse
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Any::initOnce();
        $pool->internalAddGeneratedFile(hex2bin(
            "0afd1f0a14526573756c74526573706f6e73652e70726f746f120f70726f" .
            "746f6275662e476172756461225e0a06526573756c7412230a04636f6465" .
            "18012001280e32152e70726f746f6275662e4761727564612e436f646512" .
            "0b0a036d736718022001280912220a046461746118032001280b32142e70" .
            "726f746f6275662e4761727564612e416e792ace1e0a04436f6465120b0a" .
            "0744454641554c541000120e0a0a53435f53554343455353100112200a1b" .
            "53435f54484952445f50415254595f414c52454144595f42494e44108002" .
            "12250a2053435f54484952445f434845434b5f555345525f4e4f545f5245" .
            "47495354455210810212170a1253435f4e4545445f42494e445f50484f4e" .
            "4510820212190a1453435f504152414d455445525f494e56414c49441080" .
            "20121b0a1653435f41444d494e5f4e4f5f5045524d495353494f4e108022" .
            "12230a1e53435f4143434f55544e5f555345525f544f4b454e5f4e4f544d" .
            "41544348108040121f0a1a53435f4c4f47494e45445f494e5f4f54484552" .
            "5f44455649434510814012200a1b53435f534d535f5645524946595f434f" .
            "44455f4e4f4d4f42494c45108120121c0a1753435f534d535f5645524946" .
            "595f434f44455f4641494c10822012200a1b53435f534d535f5645524946" .
            "595f434f44455f4e4f544d4154434810832012270a2253435f4143434f55" .
            "4e545f4d4f42494c455f50484f4e455f52455045544954494f4e10842012" .
            "2a0a2553435f4143434f554e545f4d4f42494c455f50484f4e455f414c4c" .
            "52454144595f42494e4410852012230a1e53435f4143434f55544e5f5553" .
            "45525f4e414d455f464f5242494444454e10862012200a1b53435f414343" .
            "4f55544e5f54484952445f434845434b5f4641494c10872012230a1e5343" .
            "5f4143434f554e545f555345525f4e414d455f4f5645525f4c4f4e471088" .
            "2012230a1e53435f4143434f554e545f4c4956455f434f44455f4f564552" .
            "5f4c4f4e4710892012260a2153435f4143434f554e545f4c4956455f434f" .
            "44455f4e4f545f5354414e44415244109020121f0a1a53435f4143434f55" .
            "4e545f4c4956455f434f44455f455849535410912012200a1b53435f4143" .
            "434f554e545f4c4956455f5550444154455f4641494c109220121e0a1953" .
            "435f4143434f554e545f50415353574f52445f4552524f52109320121e0a" .
            "1953435f4143434f554e545f555345525f4e4f545f455849535410942012" .
            "230a1e53435f4143434f554e545f4c4956455f434f44455f544f4f5f5348" .
            "4f525410952012230a1e53435f4143434f554e545f5349474e4154555245" .
            "5f4f5645525f4c4f4e47109620121e0a1953435f4143434f55544e5f5553" .
            "45525f464f5242494444454e109720121f0a1a53435f4143434f554e545f" .
            "52414e444f4d5f4e4f544558495354109820121e0a1953435f4143434f55" .
            "4e545f52414e444f4d5f4e4f545343414e109920121e0a1953435f414343" .
            "4f554e545f52414e444f4d5f5343414e4e454410a020122a0a2553435f41" .
            "43434f554e545f4c4956455f434f44455f4e4f4c595f4d4f444946595f4f" .
            "4e434510a12012260a2153435f4143434f554e545f555345525f4f525f50" .
            "415353574f52445f4552524f5210a220121d0a1853435f454d41494c5f53" .
            "454e445f4f5645525f4c494d495410a320121c0a1753435f454d41494c5f" .
            "5645524946595f494e56414c494410a42012180a1353435f454d41494c5f" .
            "4e4f545f56455249465910a52012150a1053435f4e4545445f5245474953" .
            "54455210a62012190a1453435f53454e5349544956455f434f4e54454e54" .
            "108124121b0a1653435f4d414c4c5f474946545f4e4f545f455849535410" .
            "816012210a1c53435f4d414c4c5f5452414e53414354494f4e5f52455045" .
            "41544544108260121d0a1853435f4d414c4c5f4d4f4e45595f4e4f545f45" .
            "4e4f55474810836012220a1d53435f4d414c4c5f5452414e53414354494f" .
            "4e5f4e4f545f455849535410846012220a1d53435f4d414c4c5f50524f44" .
            "5543545f4e4f545f415641494c41424c45108560121c0a1753435f4d414c" .
            "4c5f4f524445525f4e4f545f4558495354108660121f0a1a53435f4d414c" .
            "4c5f554e49464945445f4f524445525f4641494c10876012150a1053435f" .
            "4d414c4c5f5041595f4641494c108860121b0a1653435f4d414c4c5f5041" .
            "595f51554552595f4641494c108960121e0a1953435f4d414c4c5f494150" .
            "5f56414c49444154455f4641494c108a6012250a2053435f4d414c4c5f4f" .
            "524445525f45584953545f4e4f545f46494e4953484544108b60121c0a17" .
            "53435f4d414c4c5f4e4f545f42494e445f574543484154108c6012220a1d" .
            "53435f4d414c4c5f4558434545445f57495448445241575f54494d455310" .
            "8d6012220a1d53435f4d414c4c5f4558434545445f57495448445241575f" .
            "51554f5441108e60121a0a1553435f4d414c4c5f57495448445241575f46" .
            "41494c108f6012230a1e53435f4d414c4c5f57495448445241575f4c4553" .
            "535f5448414e5f4d494e10906012260a2153435f4d414c4c5f5749544844" .
            "5241575f475245415445525f5448414e5f4d415810916012200a1b53435f" .
            "4d414c4c5f57495448445241575f465245515f4c494d495410926012230a" .
            "1e53435f4d414c4c5f57495448445241575f53454e444e554d5f4c494d49" .
            "54109360121c0a1753435f4d414c4c5f4e4f545f42494e445f5041595041" .
            "4c109460121e0a1953435f4d414c4c5f4941425f56414c49444154455f46" .
            "41494c10956012220a1d53435f4d414c4c5f4255595f47554152445f4449" .
            "414d4f4e445f4c4f5710966012220a1d53435f4d414c4c5f5452414e534c" .
            "4154455f4e4f545f535550504f5254109760121d0a1853435f4d414c4c5f" .
            "5452414e534c4154455f434c4f53454410986012200a1b53435f4d414c4c" .
            "5f474946545f53454e445f5649505f4c494d4954109960121b0a1653435f" .
            "4d414c4c5f474946545f4e4f545f414c4c4f5710a060121f0a1a53435f4d" .
            "414c4c5f474946545f4e4545445f524543484152474510a160121f0a1953" .
            "435f434f4e544143545f414c52454144595f465249454e4410818001121c" .
            "0a1653435f4c4956455f524f4f4d5f4e4f545f45584953541081a001121b" .
            "0a1553435f4c4956455f524f4f4d5f44495341424c45441082a00112200a" .
            "1a53435f4c4956455f524f4f4d5f4e4f5f5045524d495353494f4e1083a0" .
            "0112280a2253435f4c4956455f524f4f4d5f555345525f47524144455f4e" .
            "4f545f454e4f5547481084a00112250a1f53435f4c4956455f524f4f4d5f" .
            "5350454349414c5f4e4f545f4352454154451085a00112240a1e53435f4c" .
            "4956455f524f4f4d5f41444d494e5f5348555455505f4641494c1086a001" .
            "12240a1e53435f4c4956455f524f4f4d5f41444d494e5f4c49465445445f" .
            "4641494c1087a001122a0a2453435f4c4956455f524f4f4d5f41444d494e" .
            "5f5348555455505f554944535f4552524f521088a001121e0a1853435f4c" .
            "4956455f524f4f4d5f4e4f5f54454c5f415554481089a001121d0a175343" .
            "5f4c4956455f524f4f4d5f464f524345445f4f5554108aa00112220a1c53" .
            "435f4c4956455f524f4f4d5f504f4c4943595f44495341424c4544108ba0" .
            "0112230a1d53435f4c4956455f524f4f4d5f5249445f5549445f4e4f544d" .
            "41544348108ca00112230a1d53435f4c4956455f524f4f4d5f4e4f5f5245" .
            "414c4e414d455f415554481090a00112230a1d53435f4c4956455f524f4f" .
            "4d5f4e4f545f494e5f4d554c54494c4956451091a001121d0a1753435f4c" .
            "4956455f524f4f4d5f5041595f4641494c45441092a00112230a1d53435f" .
            "4c4956455f524f4f4d5f43414e4e4f545f4d554c54494c4956451093a001" .
            "122a0a2453435f4c4956455f524f4f4d5f4d554c54494c4956455f4d454d" .
            "424552535f4c494d49541094a00112360a3053435f4c4956455f524f4f4d" .
            "5f4d554c54494c4956455f4352454154455f4d454554494e47524f4f4d5f" .
            "4641494c45441095a00112230a1d53435f4c4956455f524f4f4d5f4d554c" .
            "54494c4956455f46494e4953481096a00112270a2153435f414354495649" .
            "54595f53454e445f4449414d4f4e445f54494d455f454e441081c0011229" .
            "0a2353435f41435449564954595f53454e445f4449414d4f4e445f4f5645" .
            "525f4c494d49541082c00112260a2053435f41435449564954595f53454e" .
            "445f4449414d4f4e445f414c52454144591083c001121d0a1753435f4143" .
            "5449564954595f4e4f5f52454348415247451084c00112200a1a53435f41" .
            "435449564954595f4e4f545f434f4e444954494f4e531085c00112160a0f" .
            "53435f53595354454d5f4552524f5210ffffff07121f0a1953435f5a4d58" .
            "595f415554485f42494e445f535543434553531081e00112210a1b53435f" .
            "5a4d58595f415554485f4841535f4245454e5f55534545441082e001121b" .
            "0a1553435f5a4d58595f415554485f4841535f42494e441083e00112180a" .
            "1253435f5a4d58595f415554485f4552524f521084e00112200a1a53435f" .
            "5245445041434b45545f4f5645524455455f4552524f521081800212240a" .
            "1e53435f5245445041434b45545f44495354524942555445445f4552524f" .
            "5210828002121f0a1953435f5245445041434b45545f5245504541545f45" .
            "52524f521083800212200a1a53435f5045524d495353494f4e5553455f4e" .
            "4f545f414c4c4f571081a00212250a1f53435f5045524d495353494f4e55" .
            "53455f4c4f575f5045524d495353494f4e1082a00212230a1d53435f5045" .
            "524d495353494f4e5553455f4f5645525f524f4f4d4d41581083a0021222" .
            "0a1c53435f5045524d495353494f4e5553455f4f5645525f4441594d4158" .
            "1084a00212250a1f53435f5045524d495353494f4e5553455f4f5645525f" .
            "4144445f4c494d49541085a002121c0a1653435f5045524d495353494f4e" .
            "5553455f4552524f521086a00212230a1d53435f5045524d495353494f4e" .
            "5553455f5245504541545f4552524f521087a00212230a1d53435f414354" .
            "49564954595f45584348414e47455f52455045415445441081800412220a" .
            "1c53435f41435449564954595f504f494e545f4e4f545f454e4f55474810" .
            "82800412220a1c53435f5041434b5f5452414e53414354494f4e5f524550" .
            "45415445441081a00412200a1a53435f5041434b5f474946545f4e4f545f" .
            "415641494c41424c451082a00412190a1353435f5041434b5f474946545f" .
            "4558504952451083a00412230a1d53435f5041434b5f5452414e53414354" .
            "494f4e5f4e4f545f45584953541084a00412120a0c53435f5041434b5f46" .
            "554c4c1085a004122a0a2453435f44594e414d49435f434f4d4d454e545f" .
            "4652455155454e43595f4c494d495445441081c00412280a2253435f4459" .
            "4e414d49435f434f4d4d454e545f574f5244535f4f5645525f4c4f4e4710" .
            "82c00412250a1f53435f44594e414d49435f4e4f545f45584953545f4f52" .
            "5f44454c455445441083c004121d0a1753435f44594e414d49435f484153" .
            "5f4e4f5f52494748541084c00412180a1253435f434845434b494e5f414c" .
            "52454144591081e004421b0a19636f6d2e61736961696e6e6f2e75706c69" .
            "76652e70726f746f620670726f746f33"
        ));

        static::$is_initialized = true;
    }
}

